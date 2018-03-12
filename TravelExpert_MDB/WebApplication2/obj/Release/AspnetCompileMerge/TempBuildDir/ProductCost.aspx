<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="ProductCost.aspx.cs" MasterPageFile="~/Site1.Master" Inherits="WebApplication2.ProductCost" %>

<%@ Register assembly="System.Web.DataVisualization, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35" namespace="System.Web.UI.DataVisualization.Charting" tagprefix="asp" %>

<asp:Content runat="server" ID="BodyContent" ContentPlaceHolderID="MainContent">
    <h2><%: Title %>.</h2>
    <p class="text-danger">
        <asp:Literal runat="server" ID="ErrorMessage" />
    </p>
    <div>



        <div class="PCpage">
        <h2><asp:Label ID="lblInfo" runat="server" CssClass="label" Font-Bold="True"></asp:Label></h2>
            </div>
        <br />
        <br />
    </div>
    
    <div style="margin-left:10%; margin-right:10%; width:80%; text-align:center;">
        <h2 style="color:white; font-family:Arial;">Booking History</h2>
        <asp:Chart ID="ChartSum" runat="server" BackColor="Transparent"  Width="500px" Height="500px">
        <series>
            <asp:Series ChartType="Doughnut" Name="Series1" ChartArea="ChartArea1" CustomProperties="PieStartAngle=270">
            </asp:Series>
        </series>
        <chartareas>
            <asp:ChartArea Name="ChartArea1" BackColor="Transparent">
            </asp:ChartArea>
        </chartareas>
         <Titles>
             <asp:Title Name="Title1">
             </asp:Title>
         </Titles>
    </asp:Chart>
    <asp:GridView ID="grvCostDetails" runat="server" CellPadding="4" ForeColor="Black" GridLines="Horizontal" Width="100%" BackColor="White" BorderColor="#CCCCCC" BorderStyle="None" BorderWidth="0px" CssClass="table table-striped table-bordered table-hover" Font-Bold="True">
        <FooterStyle BackColor="#CCCC99" ForeColor="Black" />
        <HeaderStyle BackColor="#333333" Font-Bold="True" ForeColor="White" />
        <PagerStyle BackColor="White" ForeColor="Black" HorizontalAlign="Right" />
        <SelectedRowStyle BackColor="#CC3333" Font-Bold="True" ForeColor="White" />
        <SortedAscendingCellStyle BackColor="#F7F7F7" />
        <SortedAscendingHeaderStyle BackColor="#4B4B4B" />
        <SortedDescendingCellStyle BackColor="#E5E5E5" />
        <SortedDescendingHeaderStyle BackColor="#242121" />
    </asp:GridView>
    <div>


        <br />
        <br />
        <asp:GridView ID="grvCostSum" runat="server" Width="100%" CellPadding="4" ForeColor="Black" GridLines="Horizontal" BackColor="White" BorderColor="#CCCCCC" BorderStyle="None" BorderWidth="0px" CssClass="table table-striped table-bordered table-hover" Font-Bold="True">
            <FooterStyle BackColor="#CCCC99" ForeColor="Black" />
            <HeaderStyle BackColor="#333333" Font-Bold="True" ForeColor="White" />
            <PagerStyle BackColor="White" ForeColor="Black" HorizontalAlign="Right" />
            <SelectedRowStyle BackColor="#CC3333" Font-Bold="True" ForeColor="White" />
            <SortedAscendingCellStyle BackColor="#F7F7F7" />
            <SortedAscendingHeaderStyle BackColor="#4B4B4B" />
            <SortedDescendingCellStyle BackColor="#E5E5E5" />
            <SortedDescendingHeaderStyle BackColor="#242121" />
        </asp:GridView>
        <asp:TextBox ID="txtTotal" runat="server" CssClass="auto-style1" Width="163px" ReadOnly="True"></asp:TextBox>
        <br />
        <br />
        <br />
        <br />


    </div>
    
    <br/><br/><br/>
        </div>


</asp:Content>
<asp:Content ID="Content1" runat="server" contentplaceholderid="head">
    <style type="text/css">
        .auto-style1 {
            margin-top: 0;
        }
    </style>
    </asp:Content>
