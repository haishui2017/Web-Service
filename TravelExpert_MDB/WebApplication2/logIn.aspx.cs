using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using WebApplication2.App_Code;
namespace WebApplication2
{   /**
     ** purpose:let custoemr validate their UserName and Password 
     ** Author:David,Zhu
     ** Date:Jan 21,2018
    **/
    public partial class WebForm2 : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            lblError.Visible = false;//when initialize page ,label for errorinformation is invisible
        }

        protected void TextBox1_TextChanged(object sender, EventArgs e)
        {

        }

        protected void Button1_Click(object sender, EventArgs e)//login button
        {
            int? custid;//initial customer ID
            custid =(int?) CustomerCheckDB.GetCustomerChecks(txtLoginUser.Text, txtLoginPass.Text);//validate this customerID and password is matched and can find them in database
            if (custid != null)//tell whther there is a customerId in database or not
            {
                Session["custid"] = custid;//Session variable is used to store customerID
                Session["custuser"] = txtLoginUser.Text;//Session variable is used to store comtomerUserName
                Session["custpass"] = txtLoginPass.Text;//Session variable is used to store customerPassword
                Response.Redirect("Home.aspx");
            }
            else
            {
                lblError.Visible = true;//WHEN THERE IS NO customerID ,activate erro label

            }
        }

        protected void Button2_Click(object sender, EventArgs e)
        {
            Response.Redirect("Home.aspx");//if login sucessfully go to home page

        }
    }
}