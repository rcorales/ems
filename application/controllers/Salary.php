<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salary extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect(base_url().'login');
        }
    }

    public function index()
    {
        $data['departments']=$this->Department_model->select_departments();
        $this->load->view('admin/header');
        $this->load->view('admin/add-salary',$data);
        $this->load->view('admin/footer');
    }

    public function invoice($id)
    {
        $data['content']=$this->Salary_model->select_salary_byID($id);
        $this->load->view('admin/header');
        $this->load->view('admin/salary-invoice',$data);
        $this->load->view('admin/footer');
    }

    public function invoicestaff($id)
    {
        $data['content']=$this->Salary_model->select_salary_byID($id);
        $this->load->view('staff/header');
        $this->load->view('staff/salaryinvoice',$data);
        $this->load->view('staff/footer');
    }

    public function invoice_print($id)
    {
        $data['content']=$this->Salary_model->select_salary_byID($id);
        $this->load->view('admin/invoice-print',$data);
    }

    public function manage()
    {
        $data['content']=$this->Salary_model->select_salary();
        $this->load->view('admin/header');
        $this->load->view('admin/manage-salary',$data);
        $this->load->view('admin/footer');
    }

    public function view()
    {
        $staff=$this->session->userdata('userid');
        $data['content']=$this->Salary_model->select_salary_byStaffID($staff);
        $this->load->view('staff/header');
        $this->load->view('staff/view-salary',$data);
        $this->load->view('staff/footer');
    }

    public function insert()
    {
        $id=$this->input->post('txtid');
        $basic=$this->input->post('txtbasic');
        $allowance=$this->input->post('txtallowance');
        $total=$this->input->post('txttotal');
        $added=$this->session->userdata('userid');

        $salary=array();
        for ($i=0; $i < count($id); $i++)
        { 
            if($total[$i]>0)
            {
                $data=$this->Salary_model->insert_salary(array('staff_id' => $id[$i],
                    'basic_salary' => $basic[$i],
                    'allowance' => $allowance[$i],
                    'total' => $total[$i],
                    'added_by' => $added)
                );
            }
        }
        
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('success', "Salary Added Succesfully"); 
        }else{
            $this->session->set_flashdata('error', "Sorry, Salary Adding Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update()
    {
        $id=$this->input->post('txtid');
        $department=$this->input->post('txtdepartment');
        $data=$this->Department_model->update_department(array('department_name'=>$department),$id);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('success', "Salary Updated Succesfully"); 
        }else{
            $this->session->set_flashdata('error', "Sorry, Salary Update Failed.");
        }
        redirect(base_url()."department/manage_department");
    }


    function edit($id)
    {
        $data['content']=$this->Department_model->select_department_byID($id);
        $this->load->view('admin/header');
        $this->load->view('admin/edit-department',$data);
        $this->load->view('admin/footer');
    }


    function delete($id)
    {
        $data=$this->Salary_model->delete_salary($id);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('success', "Salary Deleted Succesfully"); 
        }else{
            $this->session->set_flashdata('error', "Sorry, Salary Delete Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function get_salary_list()
    {
        $dept = $_POST['dept'];
        $data = $this->Staff_model->select_staff_byDept($dept);
    
        if (isset($data)) {
            ?>
            <div class="box-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Staff</th>
                                    <th>Basic Salary ($)</th>
                                    <th>Allowance ($)</th>
                                    <th>PAG-IBIG Contributions ($)</th>
                                    <th>SSS Contributions ($)</th>
                                    <th>PhilHealth Contributions ($)</th>
                                    <th>Tax Percentage(%)</th>
                                    <th>Total ($)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $d) : ?>
                                    <tr>
                                        <td><?= $d["staff_name"] ?></td>
                                        <td>
                                            <input type="hidden" name="txtid[]" value="<?= $d["id"] ?>">
                                            <input type="text" name="txtbasic[]" class="form-control expenses" oninput="calculateTotal(this)">
                                        </td>
                                        <td><input type="text" name="txtallowance[]" class="form-control expenses" oninput="calculateTotal(this)"></td>
                                        <td><input type="text" name="txtpagibig[]" class="form-control pagibig" oninput="calculateTotal(this)"></td>
                                        <td><input type="text" name="txtsss[]" class="form-control sss" oninput="calculateTotal(this)"></td>
                                        <td><input type="text" name="txtphilhealth[]" class="form-control philhealth" oninput="calculateTotal(this)"></td>
                                        <td><input type="text" name="txttaxpercentage[]" class="form-control taxpercentage" oninput="calculateTotal(this)"></td>
                                        <td><input type="text" name="txttotal[]" class="form-control total" readonly></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success pull-right">Submit</button>
            </div>
            <script>
                function calculateTotal(input) {
                    var row = input.closest("tr");
                    var basic = parseFloat(row.querySelector("[name='txtbasic[]']").value) || 0;
                    var allowance = parseFloat(row.querySelector("[name='txtallowance[]']").value) || 0;
                    var pagibig = parseFloat(row.querySelector("[name='txtpagibig[]']").value) || 0;
                    var sss = parseFloat(row.querySelector("[name='txtsss[]']").value) || 0;
                    var philhealth = parseFloat(row.querySelector("[name='txtphilhealth[]']").value) || 0;
                    var taxpercentage = parseFloat(row.querySelector("[name='txttaxpercentage[]']").value) || 0;
    
                    var total = basic - (pagibig + sss + philhealth + (basic * taxpercentage)) + allowance;
    
                    row.querySelector("[name='txttotal[]']").value = total.toFixed(2);
                }
            </script>
            <?php
        }
    }
}    
    