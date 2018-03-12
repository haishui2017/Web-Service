using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data.SqlClient;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace WebApplication2.App_Code
{   /**
     **purpose:let custoemr validate their UserName and Password 
     **Author:Slavo
     **Date:Jan 21,2018
   **/
    public static class TEDB
    {
        public static SqlConnection GetConnection()
        {
            string connectionString = ConfigurationManager.ConnectionStrings["TEDBConnection"].ConnectionString;//connet to local sql server
            SqlConnection connection = new SqlConnection(connectionString);
            return connection;
        }
    }
}
