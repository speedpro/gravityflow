<?php
/*
 * Purpose: Test the approval steps
 */

// @group step-approval
// @group step-user_input
// @group step-notification

$I = new AcceptanceTester( $scenario );

$I->wantTo( 'Test the approval steps' );

// Submit the form
$I->amOnPage( '/0008-request-salary-raise' );

$I->waitForText( 'Request Salary Raise', 3 );
$I->scrollTo( [ 'css' => '.gform_title' ], 20, 50 ); // needed for chromedriver
$I->selectOption( 'select[name=input_2]', 'Third Choice' );
$I->fillField( 'input[name=input_1]', '1234' );
$I->scrollTo( [ 'css' => 'input[type=submit]' ], 20, 50 ); // needed for chromedriver
$I->click( 'Submit' );
$I->waitForText( 'Thanks for contacting us! We will get in touch with you shortly.', 3 );

// Login to wp-admin
$I->loginAsAdmin();

// Go to Inbox
$I->amOnWorkflowPage( 'Inbox' );
$I->waitForText( 'Request Salary Raise', 3 );
$I->click( '0008 Request Salary Raise' );

// Approve
$I->waitForElement( 'button[value=approved]', 3 );
$I->click( 'button[value=approved]' );

// Send to CEO
$I->waitForElement( 'select[name=gravityflow_admin_action]', 3 );
$I->selectOption( 'select[name=gravityflow_admin_action]', 'CEO approval' );
$I->click( 'Apply' );

// Approve
$I->waitForElement( 'button[value=approved]', 3 );
$I->click( 'button[value=approved]' );

$I->waitForText( 'Status: Approved', 3 );
$I->see( 'Status: Approved' );
