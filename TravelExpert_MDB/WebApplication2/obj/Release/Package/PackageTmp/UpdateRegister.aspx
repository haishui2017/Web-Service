<%@ Page Language="C#" AutoEventWireup="true" MasterPageFile="~/Site1.Master" CodeBehind="UpdateRegister.aspx.cs" Inherits="WebApplication2.UpdateRegister" %>

<asp:Content runat="server" ID="BodyContent" ContentPlaceHolderID="MainContent">
    <h2><%: Title %>.</h2>
    <p class="text-danger">
        <asp:Literal runat="server" ID="ErrorMessage" />
    </p>



  
    <div class="form-horizontal myPad" id="RegFont">
        <h2 class="display-1">Modify your profile</h2>
        <p></p>
        <p>
            <asp:Label ID="lblError" runat="server" ForeColor="Red" Text=" "></asp:Label>
        </p>
        <br/><br/><br/>
       
        
        
       

         <!-------------Personal Info------------->
        <!--First Name-->
        <div class="form-group myPad" >
            <asp:Label runat="server" AssociatedControlID="txtFirstName" CssClass="col-md-2 control-label" style="left: 2px; top: -7px; height: 14px; margin-top: 0px;">FirstName</asp:Label>
            <div class="col-md-3">
                <asp:TextBox runat="server" ID="txtFirstName" CssClass="form-control" />
                <asp:RequiredFieldValidator runat="server" ControlToValidate="txtFirstName"
                    CssClass="text-danger" ErrorMessage="FirstName is Required" ID="rqvFirstName" Display="Dynamic" Font-Bold="True" />
            </div>
        </div>
        <!--Last Name-->
        <div class="form-group myPad">
            <asp:Label runat="server" AssociatedControlID="txtLastName" CssClass="col-md-2 control-label">LastName</asp:Label>
            <div class="col-md-3">
                <asp:TextBox runat="server" ID="txtLastName" CssClass="form-control" />
                <asp:RequiredFieldValidator runat="server" ControlToValidate="txtLastName"
                    CssClass="text-danger" ErrorMessage="LastName is Required." ID="rqvLastName" Display="Dynamic" Font-Bold="True"/>
            </div>
        </div>
        <!--Email-->
        <div class="form-group myPad">
            <asp:Label runat="server" AssociatedControlID="txtEmail" CssClass="col-md-2 control-label">Email</asp:Label>
            <div class="col-md-3">
                <asp:TextBox runat="server" ID="txtEmail" CssClass="form-control" TextMode="Email" />
               
                <asp:RegularExpressionValidator ID="RegularExpressionValidator7" runat="server" ControlToValidate="txtEmail" Display="Dynamic" ErrorMessage="Please input correct Email.com" Font-Bold="True" ForeColor="#993333" ValidationExpression="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"></asp:RegularExpressionValidator>
               
            </div>
           
        </div>
        
        <!--Cell Phone-->
        <div class="form-group myPad">
            <asp:Label runat="server" AssociatedControlID="txtCellPhone" CssClass="col-md-2 control-label">CellPhone</asp:Label>
            <div class="col-md-3">
                <asp:TextBox runat="server" ID="txtCellPhone" CssClass="form-control" TextMode="Phone" />
               
            </div>
            <div>
                 <asp:RegularExpressionValidator ID="RegularExpressionValidator1" runat="server" ControlToValidate="txtCellPhone" CssClass="danger" ErrorMessage="Cellphone follow (403)555-8899" ValidationExpression="^[(]\d{3}[)]\d{3}[-]\d{4}$" Display="Dynamic" Font-Bold="True"></asp:RegularExpressionValidator>

            </div>
        </div>
         <!--Home Phone-->
        <div class="form-group myPad">
            <asp:Label runat="server" AssociatedControlID="txtHomePhone" CssClass="col-md-2 control-label">HomePhone</asp:Label>
            <div class="col-md-3">
                <asp:TextBox runat="server" ID="txtHomePhone" CssClass="form-control" TextMode="Phone" />
                <asp:RequiredFieldValidator runat="server" ControlToValidate="txtHomePhone"
                    CssClass="text-danger" ErrorMessage="HomePhone is required." ID="rqvHomePhone" Display="Dynamic" Font-Bold="True" />
              
            &nbsp;<asp:RegularExpressionValidator ID="RegularExpressionValidator5" runat="server" ControlToValidate="txtHomePhone" CssClass="danger" ErrorMessage="Please follow the format (403)555-8899." ValidationExpression="^[(]\d{3}[)]\d{3}[-]\d{4}$" Display="Dynamic" Font-Bold="True"></asp:RegularExpressionValidator>
              
            </div>
        </div>
        <br/><br/>
       
         <!-------------Address Info-------------->
        <!--Address-->
      <div class="form-group myPad">
            <asp:Label runat="server" AssociatedControlID="txtAddress" CssClass="col-md-2 control-label">Address</asp:Label>
            <div class="col-md-3">
                <asp:TextBox runat="server" ID="txtAddress" CssClass="form-control" />
                <asp:RequiredFieldValidator runat="server" ControlToValidate="txtAddress"
                    CssClass="text-danger" ErrorMessage="Address is required." ID="rfvAddress" Display="Dynamic" Font-Bold="True" />
            </div>
        </div>
        <!--City-->
       <div class="form-group myPad">
            <asp:Label runat="server" AssociatedControlID="txtCity" CssClass="col-md-2 control-label">City</asp:Label>
            <div class="col-md-3">
                <asp:TextBox runat="server" ID="txtCity" CssClass="form-control" />
                <asp:RequiredFieldValidator runat="server" ControlToValidate="txtCity"
                    CssClass="text-danger" ErrorMessage="City is required." ID="rfvCity" Display="Dynamic" Font-Bold="True" />
            </div>
        </div>
        <!--Province-->
        <div class="form-group myPad">
            <asp:Label runat="server" AssociatedControlID="dplProvince" CssClass="col-md-2 control-label">Province</asp:Label>
            <div class="col-md-3">
                <asp:DropDownList ID="dplProvince" runat="server" ForeColor="Blue" Height="23px" Width="156px">
                </asp:DropDownList>
            </div>
        </div>
        <!--Postal-->
         <div class="form-group myPad">
            <asp:Label runat="server" AssociatedControlID="txtPostal" CssClass="col-md-2 control-label">PostalCode</asp:Label>
            <div class="col-md-3">
                <asp:TextBox runat="server" ID="txtPostal" CssClass="form-control" />
                <asp:RequiredFieldValidator runat="server" ControlToValidate="txtPostal"
                    CssClass="text-danger" ErrorMessage="PostCode is required." ID="rfvPostal" Display="Dynamic" Font-Bold="True" />
               
            </div>
             <div>
                  <asp:RegularExpressionValidator ID="RegularExpressionValidator6" runat="server" ControlToValidate="txtPostal" ErrorMessage="PostCode follows T6W 3R2" ValidationExpression="^[A-Z]\d[A-Z] ?\d[A-Z]\d$" Display="Dynamic"></asp:RegularExpressionValidator>

             </div>
        </div>
        <!--Country-->
         <div class="form-group myPad">
            <asp:Label runat="server" AssociatedControlID="txtCountry" CssClass="col-md-2 control-label">Country</asp:Label>
            <div class="col-md-3">
                <asp:TextBox runat="server" ID="txtCountry" CssClass="form-control" />
                <asp:RequiredFieldValidator runat="server" ControlToValidate="txtCountry"
                    CssClass="text-danger" ErrorMessage="Country is required." ID="rfvCountry" Display="Dynamic" Font-Bold="True" />
            </div>
        </div><br/> <br/>
         <!-------------User Name Info------------>
         <!--User Name-->
        <div class="form-group myPad">
            <asp:Label runat="server" AssociatedControlID="txtUserName" CssClass="col-md-2 control-label">UserName</asp:Label>
            <div class="col-md-3">
                <asp:TextBox runat="server" ID="txtUserName" CssClass="form-control" ReadOnly="True" />
                <asp:RequiredFieldValidator runat="server" ControlToValidate="txtUserName"
                    CssClass="text-danger" ErrorMessage="User Name is Required." ID="rfvUserName" Display="Dynamic" Font-Bold="True" />
            
            <asp:RegularExpressionValidator ID="RegularExpressionValidator_UserName" runat="server" ControlToValidate="txtUserName" CssClass="text-danger" ErrorMessage="You must input at Least 6 Characters." ValidationExpression="^.{6,}$" ForeColor="Red" Display="Dynamic" Font-Bold="True"></asp:RegularExpressionValidator>
            
            </div>
        </div>
        <!--Password-->
          <div class="form-group myPad">
            <asp:Label runat="server" AssociatedControlID="txtPassword" CssClass="col-md-2 control-label">Password</asp:Label>
            <div class="col-md-3">
                <asp:TextBox runat="server" ID="txtPassword" TextMode="Password" CssClass="form-control" />
                <asp:RequiredFieldValidator runat="server" ControlToValidate="txtPassword"
                    CssClass="text-danger" ErrorMessage="The password field is required." ID="rqvPassword" Display="Dynamic" Font-Bold="True" />
        
            <asp:RegularExpressionValidator ID="revPasswprd" runat="server" ControlToValidate="txtPassword" ErrorMessage="Password should include at least 8 characters including capital and number!" ValidationExpression="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" ForeColor="Red" Display="Dynamic" Font-Bold="True"></asp:RegularExpressionValidator>
        
            </div>
        </div>
                <!--Password  Confirm-->
        <div class="form-group myPad">
            <asp:Label runat="server" AssociatedControlID="txtConfirmPassword" CssClass="col-md-2 control-label" style="left: 0px; top: -2px">Confirm password</asp:Label>
            <div class="col-md-3">
                <asp:TextBox runat="server" ID="txtConfirmPassword" TextMode="Password" CssClass="form-control" />
                <asp:RequiredFieldValidator runat="server" ControlToValidate="txtConfirmPassword"
                    CssClass="text-danger" Display="Dynamic" ErrorMessage="The confirm password field is required." ID="rqvConfirPassword" Font-Bold="True" />
                <asp:CompareValidator runat="server" ControlToCompare="txtPassword" ControlToValidate="txtConfirmPassword"
                    CssClass="text-danger" Display="Dynamic" ErrorMessage="The password and confirmation password do not match." ForeColor="Red" Font-Bold="True" />
            </div>
        </div>

         <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <asp:Button runat="server"  Text="update" CssClass="btn btn-default" OnClick="UpdateCustomer_Click" />
            </div>
        </div>


    </div>

</asp:Content>
<asp:Content ID="Content1" runat="server" contentplaceholderid="head">
    </asp:Content>

