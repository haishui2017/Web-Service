using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WebApplication2.App_Code
{   /**
     ** purpose:store products and prices for a customer 
     ** Author:David,Zhu
     ** Date:Jan 21,2018
    **/


    public class CustCost// this class is for get related products,price cost for customer
    {
        //public int CustomerId { get; set; }
        public int BookingId { get; set; }
        public string ProductName { get; set; }
      //  public string PackageName { get; set; } //in databse,this is null
        public decimal PackageBasePrice { get; set; }
        public decimal PackageAgencyCommission { get; set; }
        public decimal TravelerCount { get; set; }



    }
}