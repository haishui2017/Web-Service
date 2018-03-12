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
     ** purpose:let custoemr register their information
     ** Author:Sabrina,Gomes
     ** Date:Jan 21,2018
    **/
    public partial class WebForm1 : System.Web.UI.Page
    {
        public Customer customer;
        protected void Page_Load(object sender, EventArgs e)
        {
            //dpbProvince.Items.Add("AB");
            List<string> Prolist = new List<string>(new string[] { "AB", "BC", "MB","NB","NL","NT","NS","NU","ON","PE","QC","SK","YT" });
           
            dpbProvince.DataSource = Prolist;
            dpbProvince.DataBind();
            dpbProvince.Text = "AB";


        }

        protected void AddCustomer_Click(object sender, EventArgs e)
        {
            
            customer = new Customer();
            SetCustomerReg(customer);//set textbox value to object customer,password has been md5ed 

          
            try

            {
                if (CustomerDB.checkUserId(txtUserName.Text))//check username is registered or not
                {
                  
                    customer.CustomerId = CustomerDB.AddCustomer(customer);//get existed customerID
                    lblError.Text = "This UserName has been registered!";
                }
                else
                {
                   
                    CustomerDB.AddCustomer(customer);//insert new customer
                    lblError.Text = "You have successfully registered!";
                }
            }
            catch(Exception ex)
            {
                throw ex;
               
            }

        }

        private void SetCustomerReg(Customer customer)//set textbox values to customer object
        {
            customer.CustFirstName = txtFirstName.Text;
            customer.CustLastName = txtLastName.Text;
            customer.CustAddress = txtAddress.Text;
            customer.CustCity = txtCity.Text;
            customer.CustProv = dpbProvince.Text;
            customer.CustPostal = txtPostal.Text;
            customer.CustCountry = txtCountry.Text;
            customer.CustHomePhone = txtHomePhone.Text;
            customer.CustBusPhone = txtCellPhone.Text;
            customer.CustEmail = txtEmail.Text;
            customer.AgentId = null;
            customer.CustUser = txtUserName.Text;
            customer.CustPass = FormsAuthentication.HashPasswordForStoringInConfigFile(txtPassword.Text, "MD5");//apply MD5 to hashed password
        }

    }

   
}