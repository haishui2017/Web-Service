using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.Security;
using System.Web.UI.WebControls;

namespace WebApplication2.App_Code
{   /**
     ** purpose:check username and password is matched ornot and in database
     ** Author:Slavo
     ** Date:Jan 21,2018
    **/
    public static class CustomerCheckDB
    {   
        public static int? GetCustomerChecks(string custuser,string custpass)
        {
            int? custid = null;//initial value for custid
            string md5pass= FormsAuthentication.HashPasswordForStoringInConfigFile(custpass, "MD5");//applied hash method to encrypt password inputed from Login.aspx
            SqlConnection connection = TEDB.GetConnection();//connect to database
            string selectSql = "Select CustomerId from Customers where CustUser=@custuser and CustPass=@custpass";
            SqlCommand selectCommand = new SqlCommand(selectSql, connection);
            selectCommand.Parameters.AddWithValue("@custuser", custuser);
            selectCommand.Parameters.AddWithValue("@custpass", md5pass);//only passed encrypted password into database
            try
            {
                connection.Open();
                SqlDataReader reader = selectCommand.ExecuteReader(System.Data.CommandBehavior.SingleRow);//get only one row back
                if (reader.Read())
                {
                   
                    custid= Convert.ToInt32(reader["CustomerId"]);//get existed customerID
                }
                
                reader.Close();
            }
            catch(Exception ex)
            {
                throw ex;
            }
            finally
            {
                connection.Close();
            }
            return custid;

        }
     
             
    }
}