<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="logIn.aspx.cs" Inherits="WebApplication2.WebForm2" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <script src="Scripts/jquery-1.9.1.min.js"></script>
    <link href="Content/bootstrap.min.css" rel="stylesheet" />
    <script src="Scripts/bootstrap.min.js"></script>
    <link href="CSS/style.css" rel="stylesheet" />
    <title></title>
</head>
<body>

    <form id="form1" runat="server">
        <!--Nav-->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" runat="server" href="~/Home.aspx">Travel Experts 	&nbsp;	&nbsp;	&nbsp; <span style="font-size:12px;"><% if (Session["custid"] != null)
                              { %> <%="Welcome, " + Session["custuser"] %><%} %></span></a>
                </div>
                <div class="navbar-collapse collapse" id="defaultNav" runat="server">
                    <ul class="nav navbar-nav">
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <% if (Session["custid"] != null)
                            {%> 
                         <li><a runat="server" href="~/UpdateRegister.aspx">Profile</a></li>
                         <li><a runat="server" href="~/ProductCost.aspx">BookingHistory</a></li>
                         <li><a runat="server" href="~/Sessionclear.aspx" >Log Out</a></li>
                        <%}
                         else
                        { %>
                        <li><a runat="server" href="~/Register.aspx">Register</a></li>
                        <li><a runat="server" href="~/Login.aspx" id="Login1">Log in</a></li>
                       <% } %>

                      
                    </ul>
                </div>
                <div class="navbar-collapse collapse" id="loggedInNav" runat="server">
                    
                </div>
            </div>
        </div>
        <!--Nav end-->
        <br/><br/><br/><br/>
    <div class="container">
        <div class="card card-container">
           
            <!--login and submit-->
            <div id="profile-name" class="profile-name-card">
                <asp:TextBox ID="txtLoginUser" runat="server" placeholder="Username" CssClass="form-control"></asp:TextBox><br/>
                <asp:TextBox ID="txtLoginPass" runat="server"  placeholder="Password" OnTextChanged="TextBox1_TextChanged" CssClass="form-control" TextMode="Password"></asp:TextBox>
                <asp:Label ID="lblError" runat="server" ForeColor="Red" Text="Your username or password is incorrect!"></asp:Label>
                <br/>
               <div class="col-md-6"> <asp:Button ID="Button1" runat="server" Text="Login" CssClass="btn btn-lg btn-primary btn-block btn-signin" OnClick="Button1_Click" Width="120px"/></div>
               <div class="col-md-6"> <asp:Button ID="Button2" runat="server" Text="Cancel" CssClass="btn btn-lg btn-primary btn-block btn-signin" Width="120px" OnClick="Button2_Click"/></div>
                <br/><br/>
            </div>
                
            <!-- /form -->
            
        </div><!-- /card-container -->
    </div><!-- /container -->
    </form>
</body>
</html>
