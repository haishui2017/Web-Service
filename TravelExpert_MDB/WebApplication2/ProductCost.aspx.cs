using System;
using System.Collections.Generic;
using System.Drawing;
using System.Globalization;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using WebApplication2.App_Code;
namespace WebApplication2
{  /**
     ** purpose:display sumary data of products purchased by customer
     ** Author:David,Zhu
     ** Date:Jan 21,2018
    **/
    public partial class ProductCost : System.Web.UI.Page
    {
        public List<CustCost> custcosts;//get all reocrds from joints tables
        public decimal sumCost;//total consume money
        protected void Page_Load(object sender, EventArgs e)
        {
            Response.Cache.SetCacheability(HttpCacheability.NoCache);//clear cache
            Response.Cache.SetExpires(DateTime.Now.AddDays(-1));//set Session Expires
            Response.Cache.SetNoStore();


            if (Session["custid"] == null)//tell whether login or not
            {
                Response.Redirect("logIn.aspx");//if session[] is killed ,then go to login.aspx
            }

            if (!IsPostBack)//for first time to load this page
            {

                try
                {
                    int custid;
                    custid = Convert.ToInt32(Session["custid"]);
                    custcosts = ProductDB.AccountByProduct(custid);//load related booking info accroding to custid

                }
                catch (Exception ex)
                {
                    throw ex;
                }

                if (custcosts.Count != 0)//if returning is not null
                {
                    var details = from cs in custcosts
                                  orderby cs.ProductName //return booking and cost details order by productname
                                  select new
                                  {
                                      ProductName = cs.ProductName,
                                      Baseprice = cs.PackageBasePrice.ToString("c"),
                                      Admission = cs.PackageAgencyCommission.ToString("c"),
                                      Traveler = cs.TravelerCount.ToString(),
                                      TotalCost = (cs.PackageBasePrice * cs.TravelerCount + cs.PackageAgencyCommission).ToString("c")//


                                  };
                    grvCostDetails.DataSource = details.ToList();
                    grvCostDetails.DataBind();
                    var summarys = from cs in custcosts //sumary LINQ according to group by productname
                                   group cs by cs.ProductName into pn
                                   orderby pn.Sum(x => x.PackageBasePrice * x.TravelerCount + x.PackageAgencyCommission)//get cost for each package
                                   select new
                                   {
                                      Productname = pn.Key,
                                      Sumcost = pn.Sum(x => x.PackageBasePrice * x.TravelerCount + x.PackageAgencyCommission).ToString("c")

                                   };

                    foreach (var ls in summarys.ToList())//sum up all costs
                    {
                        sumCost += decimal.Parse(ls.Sumcost, NumberStyles.Currency);// Get total cost
                    }
                    grvCostSum.DataSource = summarys.ToList();
                    grvCostSum.DataBind();
                    txtTotal.Text = "TotalCost is " + sumCost.ToString("c");
                    // lblTotalCot.Text = "TotalCost is " + sumCost.ToString("c");
                    //set pie chart configuration
                   //  ChartSum.Width = Unit.Percentage(100);
                    ChartSum.DataSource = summarys.ToList();//set datasource to piechart
                    ChartSum.Series[0].XValueMember = "Productname";//set category name
                    ChartSum.Series[0].YValueMembers = "Sumcost";//set display value
                    ChartSum.Series[0].Label =  "#VALX" + "#PERCENT{P0}";//set dispaly format
                    ChartSum.Series[0].Font = new Font("Arial",15, FontStyle.Bold);
                    ChartSum.Series[0]["DoughnutRadius"] = "60";
                    ChartSum.DataBind();


                }
                else
                {
                    lblInfo.Text = Session["Custuser"].ToString() + " has no relative booking record !";
                    ChartSum.Visible = false;
                    txtTotal.Visible = false; 
                 }
               
            }
        }

        protected void txtTotal_TextChanged(object sender, EventArgs e)
        {

        }
    }
}