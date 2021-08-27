<?php session_start();
      require_once('../../classes/db_class.php');
      if(!isset($_SESSION['adminid'])){
        header('location: ../login');
      } 

       ///id seession
   $uid = $_SESSION['adminid'];

   ?>

<!DOCTYPE html>
<html>
<head>
	<title>Home of Migration</title>
</head>
<body>
<h2>FarmKonnect Migration - Home</h2>
<ul>
    <li><a href="add_users.php"> Add a Customer</a></li>
    <li><a href="edit_users.php"> Edit a Customer's Details</a></li>
	<!--<li><a href="withdrawals.php"> Add Withdrawals </a></li>-->
	<li><a href="view_withdrawals.php"> View Withdrawals </a></li>
	<!--<li> <a href="wallets.php"> Wallet Balance Update </a></li>-->
	<li><a href="deposits.php"> Add Deposits </a></li>
	<li><a href="view_deposits.php"> View Deposits</a></li>
	<li><a href="delete_user.php"> Delete User </a></li>
	<li><a href="change_subscription_date.php"> Change Subscription Date </a></li>
	<li><a href="wallets.php"> <span style="color:red;">Update Wallet</span> </a></li>
	<li><a href="old_platform_withdrawal.php"> <span style="color:red;">Log and Net Withdrawals( OLD PLATFORM)</span> </a></li>
	<!--<li><a href="#"> MIGRATION STATUS</a></li>-->
	<!--<li><a href="transfers.php"> Add Transfers </a></li>-->
	<!--<li><a href="view_transfers.php"> View Transfers</a></li>-->
	<!--<li><a href="investments1.php"> Computing Standard/Fixed Plans </a> | <a href="investments2.php"> Basal Plans/Contributory Plans</a></li>-->
	<li><a href="../logout.php"> Logout </a></li>
	<!-- <li><a href="#"> View Investments Info </a></li>
	<li><a href="#"> Reconcile Conflicts </a></li> -->
	

</ul>
<!--<h3><strong>Important Note:</strong></h3>-->
<!--<p>-->
<!--	To ensure seamless reconciliation and migration, the following should be considered:::-->
<!--</p>-->
<!--	<ul>-->
<!--	<li>1. Add All Deposits ( i.e deposits clients did from bank account to their wallets, this includes transfer from one client to another-- client as a beneficiary)</li>-->
<!--	<li>2. Add All Withdrawals ( i.e debits clients did from their wallets to their bank accounts, this includes transfer from one client to another -- client as a sender)</li>-->
<!--	<li>3. Do algorithm computation to know the current day of investment (this will help to know what profit clients has made so far): </li>-->
<!--	<li>4. Get other Benefits of Clients e.g commissions, bonuses etc </li>-->
<!--	<li>5. The Real Deal : Client's Current Wallet Balance = All deposits  - (all withdrawals, credit transfer -ve);<br> -->
<!--		If there are profits that have been transfer before, then the wallet balance will likely read -ve, so that when the profits have been moved to wallet, it can be in a balanced state-->
			
<!--	</li>-->
<!--	<li></li>-->
<!--	</ul>-->


</body>
</html>