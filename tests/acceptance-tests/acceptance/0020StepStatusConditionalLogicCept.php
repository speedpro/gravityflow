<?php
//$scenario->skip();
/*
 * Test summary: perform step if previous step status is rejected
 *
 * Test details:
 * - Fill in the form fields.
 * - Login to back-end, go to Inbox
 * - Click on the 'Step Status Conditional Logic' Workflow
 * - Click on the 'Reject' button
 * - Go to 'Approval if Previous Approval Step Rejected' step
 * - Click on the 'Approve' button
 */

// @group step-approval

$I = new AcceptanceTester( $scenario );

$I->loginAsAdmin();

$I->amOnPage( '/step-status-conditional-logic' );
$I->waitforText( 'Single Line',3 );
$I->fillField( 'Single Line', 'test' );
$I->fillField( 'Paragraph', 'test' );
$I->selectOption( 'User', '1' );
$I->click( 'Submit' );


$I->amOnWorkflowPage( 'Inbox' );
$I->waitforText( 'Step Status Conditional Logic',3 );
$I->click( 'Step Status Conditional Logic' );

$I->waitforText( 'Approval Step',3 );
$I->see( 'Approval Step', '.gravityflow-status-box' );
$I->click( 'Reject' );

$I->waitforText( 'Approval if Previous Approval Step Rejected' );
$I->see( 'Approval if Previous Approval Step Rejected', '.gravityflow-status-box' );
$I->dontSee( 'Approval if Previous Approval Step Approved', '.gravityflow-status-box' );
