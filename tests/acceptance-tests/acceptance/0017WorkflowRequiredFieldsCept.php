<?php
/*
 * Purpose: Test workflow required fields
 */

// @group step-approval
// @group step-user_input
// @group step-webhook

$I = new AcceptanceTester( $scenario );

$I->wantTo( 'Test workflow required fields' );

// Submit the form
$I->amOnPage( '/0017-workflow-required-fields' );

$I->see( '0017 Workflow Required Fields' );
$I->scrollTo( [ 'css' => '.gform_title' ], 20, 50 ); // needed for chromedriver

$I->fillField( 'input[name="input_2"]', 'Text' );
$I->fillField( 'textarea[name="input_1"]', 'Pharagraph text' );
$I->scrollTo( [ 'css' => 'input[type=submit]' ], 20, 50 ); // needed for chromedriver
$I->click( 'Submit' );
$I->waitForText( 'Thanks for contacting us! We will get in touch with you shortly.', 3 );

// Login as Admin
$I->loginAsAdmin();
$I->seeInCurrentUrl( '/wp-admin/' );

// Go to Inbox
$I->amOnWorkflowPage( 'Inbox' );
$I->click( '0017 Workflow Required Fields' );
$I->waitForText( 'Instructions: please review the values in the fields below and click on the Approve or Reject button', 3 );
$I->see( 'Instructions: please review the values in the fields below and click on the Approve or Reject button' );

$I->seeElement( 'button[value=approved]' );
$I->click( 'button[value=approved]' );

$I->waitForText( 'A note is required', 3 );
$I->fillField( 'textarea[name="gravityflow_note"]', 'First note added' );
$I->click( 'button[value=approved]' );

$I->waitForText( 'Editable instructions.', 3 );
$I->seeElement( 'input[name=gravityflow_status]' );
$I->click( 'Update' );

$I->waitForText( 'A note is required', 3 );
$I->fillField( 'textarea[name="gravityflow_note"]', 'Second note added' );
$I->click( 'Update' );
$I->selectOption( 'input[name="gravityflow_status"]', 'Complete' );
$I->click( 'Update' );

$I->waitForText( 'This field is required.', 10 );
$I->fillField( 'input[name="input_3"]', 'Required on complete' );
$I->fillField( 'textarea[name="gravityflow_note"]', 'Final note added' );
$I->selectOption( 'input[name="gravityflow_status"]', 'Complete' );
$I->click( 'Update' );

$I->waitForText( 'Entry updated and marked complete.', 3 );
