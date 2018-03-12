using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WebApplication2.App_Code
{  /**
     ** purpose:store products and prices for a customer 
     ** Author:David,Zhu
     ** Date:Jan 21,2018
    **/
    [Serializable]
    public class Customer//declare customer class to store customer info
    {
        public Customer() { }

        //define public properties
        public int? CustomerId { get; set; }//i case returned customerid is empty
        public string CustFirstName { get; set; }
        public string CustLastName { get; set; }
        public string CustAddress { get; set; }
        public string CustCity { get; set; }
        public string CustProv { get; set; }
        public string CustPostal { get; set; }
        public string CustCountry { get; set; }
        public string CustHomePhone { get; set; }
        public string CustBusPhone { get; set; }
        public string CustEmail { get; set; }
        public int? AgentId { get; set; }//agentID maybe null
        public string CustUser { get; set; }
        public string CustPass { get; set; }
    }
}