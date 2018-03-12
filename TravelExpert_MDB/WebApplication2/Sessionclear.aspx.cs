using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace WebApplication2
{
    public partial class Sessionclear : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (Session["custid"] != null)
            {
                Session["custid"] = null;
                Session["custuser"] = null;
                Session["custpass"] = null;
                Session.Abandon();
                FormsAuthentication.SignOut();
                Response.Redirect("Home.aspx");

            }
            else
            {
                Response.Redirect("LogIn.aspx");//in case someone directly run
            }
        }
    }
}