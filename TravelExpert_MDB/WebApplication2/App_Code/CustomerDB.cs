using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;

namespace WebApplication2.App_Code
{ /**
     ** purpose:set method to get corresponding customers from tabel of Customers
     ** Author:David,Zhu
     ** Date:Jan 21,2018
    **/
    public static class CustomerDB
    {
        public static Customer GetCustomer(string custUser)//this is for update.aspx pageolading 
        {
            Customer cust = null; // found customer
            // define connection
         
            SqlConnection connection = TEDB.GetConnection();
            // define the select query command
            string selectQuery = "select CustomerId, CustFirstName, CustLastName, CustAddress, CustCity, CustProv, " +
                                 "CustPostal, CustCountry, CustHomePhone, CustBusPhone, CustEmail, AgentId, " +
                                 "CustUser, CustPass " +
                                 "from Customers " +
                                 "where CustUser= @CustUser";
            SqlCommand selectCommand = new SqlCommand(selectQuery, connection);
            selectCommand.Parameters.AddWithValue("@CustUser", custUser);
            try
            {
                // open the connection
                connection.Open();

                // execute the query
                SqlDataReader reader = selectCommand.ExecuteReader();

                // process the result if any
                if (reader.Read()) // if there is customer
                {
                    cust = new Customer();
                    cust.CustomerId = (int)reader["CustomerID"];
                    cust.CustFirstName = reader["CustFirstName"].ToString();
                    cust.CustLastName = reader["CustLastName"].ToString();
                    cust.CustAddress = reader["CustAddress"].ToString();
                    cust.CustCity = reader["CustCity"].ToString();
                    cust.CustProv = reader["CustProv"].ToString();
                    cust.CustPostal = reader["CustPostal"].ToString();
                    cust.CustCountry = reader["CustCountry"].ToString();
                    cust.CustHomePhone = reader["CustHomePhone"].ToString();
                    cust.CustBusPhone = reader["CustBusPhone"].ToString();
                    cust.CustEmail = GetNullableString(reader, "CustEmail");
                    cust.AgentId = GetNullableInt(reader, "AgentId");
                    cust.CustUser = reader["CustUser"].ToString();
                    cust.CustPass = reader["CustPass"].ToString();

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

            return cust;
        }

        //check null for string fields
        public static string GetNullableString(SqlDataReader reader, string fieldName)
        {
            if (reader[fieldName] != DBNull.Value)
            {
                return reader[fieldName].ToString();
            }
            return null;
        }

        //check null for int
        public static int? GetNullableInt(SqlDataReader reader, string fieldName)
        {
            if (reader[fieldName] != DBNull.Value)
            {
                return (int)reader[fieldName];
            }
            return null;
        }

        //insert new customer to database
        public static int AddCustomer(Customer cust) // for register.aspx
        {
            int custID = 0;
            
            // prepare connection
            SqlConnection connection = TEDB.GetConnection();//connect to Database

            //Insert a new customer record to database
            string insertString = "insert into Customers " +
                                  "(CustFirstName, CustLastName, CustAddress, CustCity, CustProv, CustPostal, CustCountry, CustHomePhone, CustBusPhone, CustEmail, AgentId, CustUser, CustPass) " +
                                  "values(@CustFirstName, @CustLastName, @CustAddress, @CustCity, @CustProv, @CustPostal, @CustCountry, @CustHomePhone, @CustBusPhone, @CustEmail, @AgentId, @CustUser, @CustPass)";
            SqlCommand insertCommand = new SqlCommand(insertString, connection);
            insertCommand.Parameters.AddWithValue("@CustFirstName", cust.CustFirstName);
            insertCommand.Parameters.AddWithValue("@CustLastName", cust.CustLastName);
            insertCommand.Parameters.AddWithValue("@CustAddress", cust.CustAddress);
            insertCommand.Parameters.AddWithValue("@CustCity", cust.CustCity);
            insertCommand.Parameters.AddWithValue("@CustProv", cust.CustProv);
            insertCommand.Parameters.AddWithValue("@CustPostal", cust.CustPostal);
            insertCommand.Parameters.AddWithValue("@CustCountry", cust.CustCountry);
            insertCommand.Parameters.AddWithValue("@CustHomePhone", cust.CustHomePhone);
            insertCommand.Parameters.AddWithValue("@CustBusPhone", cust.CustBusPhone);
            insertCommand.Parameters.AddWithValue("@CustEmail", cust.CustEmail);

            insertCommand.Parameters.AddWithValue("@AgentId", DBNull.Value);//according to requirement,AgentId is null
            insertCommand.Parameters.AddWithValue("@CustUser", cust.CustUser);

            insertCommand.Parameters.AddWithValue("@CustPass", cust.CustPass);

            try
            {
                // open connection
                connection.Open();

                // execute the statement
                int i = insertCommand.ExecuteNonQuery();
                if (i == 1) // one record inserted succcessfully
                {
                    // retrieve customer id from the added record
                    string selectString = "select ident_current('Customers') " +
                                          "from Customers";
                    SqlCommand selectCommand = new SqlCommand(selectString, connection);
                    custID = Convert.ToInt32(selectCommand.ExecuteScalar()); // (int) does not work!!!
                }
            }
            catch (Exception ex)
            {
                throw ex; // pass the buck
            }
            finally
            {
                connection.Close();
            }
            return custID;
        }

        //modify customer data
        public static bool UpdateCustomer(Customer customer, Customer old_customer)//for update.aspx to update new value to customer
        {
            bool successful = false;//default condition is updating failed
            SqlConnection connection = TEDB.GetConnection();
            string updateString = "update Customers set " +
                                  "CustFirstName = @NewCustFirstName, " +
                                  "CustLastName = @NewCustLastName, " +
                                  "CustAddress = @NewCustAddress, " +
                                  "CustCity = @NewCustCity, " +
                                  "CustProv = @NewCustProv, " +
                                  "CustPostal = @NewCustPostal, " +
                                  "CustCountry = @NewCustCountry, " +
                                  "CustHomePhone = @NewCustHomePhone, " +
                                  "CustBusPhone = @NewCustBusPhone, " +
                                  "CustEmail = @NewCustEmail, " +
                                  "AgentId = @NewAgentId, " +
                                  "CustUser = @NewCustUser, " +
                                  "CustPass = @NewCustPass " +
                                  "where " + // update succeeds only if record not changed by other users
                                  "CustFirstName = @OldCustFirstName and " +
                                  "CustLastName = @OldCustLastName and " +
                                  "CustAddress = @OldCustAddress and " +
                                  "CustCity = @OldCustCity and " +
                                  "CustProv = @OldCustProv and " +
                                  "CustPostal = @OldCustPostal and " +
                                  "CustCountry = @OldCustCountry and " +
                                  "CustHomePhone = @OldCustHomePhone and " +
                                  "(CustBusPhone = @OldCustBusPhone or " +
                                  "CustBusPhone Is NULL and @OldCustBusPhone Is NULL) and " +
                                  "(CustEmail = @OldCustEmail or " +
                                  "CustEmail Is NUll and @OldCustEmail IS NULL) and " +
                                  "(AgentId = @OldAgentId or " +
                                  "AgentId IS NULL and @OldAgentId is NULL) and " +
                                  "CustUser = @OldCustUser and " +
                                  "CustPass = @OldCustPass";
            SqlCommand updateCommand = new SqlCommand(updateString, connection);
            updateCommand.Parameters.AddWithValue("@OldCustFirstName", old_customer.CustFirstName);
            updateCommand.Parameters.AddWithValue("@OldCustLastName", old_customer.CustLastName);
            updateCommand.Parameters.AddWithValue("@OldCustAddress", old_customer.CustAddress);
            updateCommand.Parameters.AddWithValue("@OldCustCity", old_customer.CustCity);
            updateCommand.Parameters.AddWithValue("@OldCustProv", old_customer.CustProv);
            updateCommand.Parameters.AddWithValue("@OldCustPostal", old_customer.CustPostal);
            updateCommand.Parameters.AddWithValue("@OldCustCountry", old_customer.CustCountry);
            updateCommand.Parameters.AddWithValue("@OldCustHomePhone", old_customer.CustHomePhone);
            if (old_customer.CustBusPhone != null)
            {
                updateCommand.Parameters.AddWithValue("@OldCustBusPhone", old_customer.CustBusPhone);
            }
            else
            {
                updateCommand.Parameters.AddWithValue("@OldCustBusPhone", DBNull.Value);
            }
            if (old_customer.CustEmail != null)
            {
                updateCommand.Parameters.AddWithValue("@OldCustEmail", old_customer.CustEmail);
            }
            else
            {
                updateCommand.Parameters.AddWithValue("@OldCustEmail", DBNull.Value);
            }
            if (old_customer.AgentId != null)
            {
                updateCommand.Parameters.AddWithValue("@OldAgentId", old_customer.AgentId);
            }

            else
            {
                updateCommand.Parameters.AddWithValue("@OldAgentId", DBNull.Value);
            }
            updateCommand.Parameters.AddWithValue("@OldCustUser", old_customer.CustUser);
            updateCommand.Parameters.AddWithValue("@OldCustPass", old_customer.CustPass);

            updateCommand.Parameters.AddWithValue("@NewCustFirstName", customer.CustFirstName);
            updateCommand.Parameters.AddWithValue("@NewCustLastName", customer.CustLastName);
            updateCommand.Parameters.AddWithValue("@NewCustAddress", customer.CustAddress);
            updateCommand.Parameters.AddWithValue("@NewCustCity", customer.CustCity);
            updateCommand.Parameters.AddWithValue("@NewCustProv", customer.CustProv);
            updateCommand.Parameters.AddWithValue("@NewCustPostal", customer.CustPostal);
            updateCommand.Parameters.AddWithValue("@NewCustCountry", customer.CustCountry);
            updateCommand.Parameters.AddWithValue("@NewCustHomePhone", customer.CustHomePhone);
            if (customer.CustBusPhone != null)
            {
                updateCommand.Parameters.AddWithValue("@NewCustBusPhone", customer.CustBusPhone);
            }
            else
            {
                updateCommand.Parameters.AddWithValue("@NewCustBusPhone", DBNull.Value);
            }
            if (customer.CustEmail != null)
            {
                updateCommand.Parameters.AddWithValue("@NewCustEmail", customer.CustEmail);
            }
            else
            {
                updateCommand.Parameters.AddWithValue("@NewCustEmail", DBNull.Value);
            }
            if (customer.AgentId != null)
            {
                updateCommand.Parameters.AddWithValue("@NewAgentId", customer.AgentId);
            }
            else
            {
                updateCommand.Parameters.AddWithValue("@NewAgentId", DBNull.Value);
            }
            updateCommand.Parameters.AddWithValue("@NewCustUser", customer.CustUser);
            updateCommand.Parameters.AddWithValue("@NewCustPass", customer.CustPass);



            try
            {
                connection.Open();
                int count = updateCommand.ExecuteNonQuery();
                if (count == 1)
                    successful = true;//if update succesfully ,return true
            }
            catch (Exception ex)
            {
                throw ex;
            }
            finally
            {
               connection.Close();
            }
            return successful;
        }

      

       
        //verify if UserId is unique
        public static bool checkUserId(string custUser)
        {
            bool successfull = false;
            int count;
            // define connection
            SqlConnection connection = TEDB.GetConnection();

            // define the select query command
            string checkUserQuery = "select count(*) " +
                                 "from Customers " +
                                 "where CustUser = @CustUser";
            SqlCommand checkUserCommand = new SqlCommand(checkUserQuery, connection);
            checkUserCommand.Parameters.AddWithValue("@CustUser", custUser);

            try
            {
                // open the connection
                connection.Open();


                count = Convert.ToInt32(checkUserCommand.ExecuteScalar());
                if (count >= 1)
                {
                    successfull =true;//there is a existig user
                }
                else
                {
                    successfull = false;//no existing user
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
            return successfull;

        }
    }
}
