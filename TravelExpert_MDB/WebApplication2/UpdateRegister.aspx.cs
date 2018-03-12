using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;
using WebApplication2.App_Code;

namespace WebApplication2
{    /**
     ** purpose:let custoemr update their information
     ** Author:timoth,Tsai
     ** Date:Jan 21,2018
    **/
    public partial class UpdateRegister : System.Web.UI.Page
    {
        public Customer cust;
        public   Customer newcust ;
        protected void Page_Load(object sender, EventArgs e)
        {
            Response.Cache.SetCacheability(HttpCacheability.NoCache);//remove caches
            Response.Cache.SetExpires(DateTime.Now.AddDays(-1));//set session Expire
            Response.Cache.SetNoStore();

            if (Session["custid"] == null)//tell whether login or not
            {
                Response.Redirect("logIn.aspx");
            }
            if (!IsPostBack)//first time to load page
            {
                List<string> Prolist = new List<string>(new string[] { "AB", "BC", "MB", "NB", "NL", "NT", "NS", "NU", "ON", "PE", "QC", "SK", "YT" });//initialize province name

                dplProvince.DataSource = Prolist;
                dplProvince.DataBind();
               
                cust = CustomerDB.GetCustomer(Session["custuser"].ToString());//get cust object for custuser=
                getCustomerReg(cust);//set textbox initial values get from database
                
              
            }
        }

        protected void UpdateCustomer_Click(object sender, EventArgs e)
        {
            
            cust = CustomerDB.GetCustomer(Session["custuser"].ToString());//old value
             
             newcust = new Customer();
             setCustomerReg(newcust);//get modified textbox  value to newcust object
            // lblError.Text = newcust.CustFirstName;
            if (CustomerDB.UpdateCustomer(newcust, cust))
            {
             
                getCustomerReg(newcust);
                lblError.Text = cust.CustUser + " has successfully updated your info !";
            }
            else
            {
                lblError.Text = "There is another user is updating or deleting your info!";
            }
           
        }
        private void getCustomerReg(Customer customer)//get data from database and assgin to textbox
        {
               txtFirstName.Text= customer.CustFirstName;
               txtLastName.Text = customer.CustLastName;
               txtAddress.Text= customer.CustAddress;
               txtCity.Text= customer.CustCity;
               dplProvince.Text= customer.CustProv;
               txtPostal.Text= customer.CustPostal;
               txtCountry.Text = customer.CustCountry ;
               txtHomePhone.Text= customer.CustHomePhone;
               txtCellPhone.Text= customer.CustBusPhone;
               txtEmail.Text= customer.CustEmail;
              // customer.AgentId = null;
               txtUserName.Text= customer.CustUser;
               txtPassword.Attributes.Add("value", Session["custpass"].ToString());//for password textbox this method to set valeu
               txtConfirmPassword.Attributes.Add("value", Session["custpass"].ToString());
               
        }
        private void setCustomerReg(Customer customer)//set modified textvalue to newcustmer object
        {
            customer.CustFirstName = txtFirstName.Text;
            customer.CustLastName = txtLastName.Text;
            customer.CustAddress = txtAddress.Text;
            customer.CustCity = txtCity.Text;
            customer.CustProv =dplProvince.Text;
            customer.CustPostal = txtPostal.Text;
            customer.CustCountry = txtCountry.Text;
            customer.CustHomePhone = txtHomePhone.Text;
            customer.CustBusPhone = txtCellPhone.Text;
            customer.CustEmail = txtEmail.Text;
            customer.AgentId = null;
            customer.CustUser = txtUserName.Text;
            customer.CustPass = FormsAuthentication.HashPasswordForStoringInConfigFile(txtPassword.Text, "MD5");
           
        }
    }
}