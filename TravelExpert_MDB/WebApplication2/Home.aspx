<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Home.aspx.cs"  MasterPageFile="~/Site1.Master"  Inherits="WebApplication2.Home" %>

<asp:Content runat="server" ID="BodyContent" ContentPlaceHolderID="MainContent">
    <h2><%: Title %>.</h2>
    <p class="text-danger">
        <asp:Literal runat="server" ID="ErrorMessage" />
    </p>
    <!--start-->
     <header class="masthead text-center text-white">
 <h1>Travel <span style="color:darkred;">Experts</span></h1>
    </header>
    
</asp:Content>
<asp:Content ID="Content1" runat="server" contentplaceholderid="head">
    </asp:Content>
