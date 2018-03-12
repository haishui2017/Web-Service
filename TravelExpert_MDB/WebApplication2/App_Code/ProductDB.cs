using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;

namespace WebApplication2.App_Code
{  /**
     ** purpose:get all of oridering history data for a specific customer
     ** Author:David,Zhu
     ** Date:Jan 21,2018
    **/
    public static class ProductDB


    {
        public static List<CustCost> AccountByProduct(int customerid)
        {

            CustCost custcost = null; // found customer
            List<CustCost> custcosts = new List<CustCost>();
          
            SqlConnection connection = TEDB.GetConnection();
            //join table bookings ,products,prodcutSuppliers
            string selectQuery = "select p.ProdName,bds.BookingId,bds.BasePrice,bds.AgencyCommission,bs.travelerCount from " +
                                 "bookings bs,BookingDetails bds,Products_Suppliers ps,Products p " +
                                 "where bs.BookingId=bds.BookingId and bds.ProductSupplierId=ps.ProductSupplierId " +
                                 "and ps.ProductId=p.ProductId and bs.CustomerId=@customerid";
            SqlCommand selectCommand = new SqlCommand(selectQuery, connection);
            selectCommand.Parameters.AddWithValue("@customerid", customerid);
            try
            {
                // open the connection
                connection.Open();

                // execute the query
                SqlDataReader reader = selectCommand.ExecuteReader();

                // process the result if any
                while (reader.Read()) // if there is customer
                {
                    custcost = new CustCost();
                    custcost.ProductName = reader["ProdName"].ToString();
                    custcost.BookingId = Convert.ToInt32(reader["BookingId"]);
                    custcost.PackageBasePrice = Convert.ToDecimal(reader["BasePrice"]);
                    custcost.PackageAgencyCommission = Convert.ToDecimal(reader["AgencyCommission"]);
                    custcost.TravelerCount=Convert.ToInt32(reader["travelerCount"]);
                    custcosts.Add(custcost);
                }
            }
            catch (Exception ex)
            {
                throw ex; // let the form handle it
            }
            finally
            {
                connection.Close(); // close connecto no matter what
            }

            return custcosts;
        }




    }


}
