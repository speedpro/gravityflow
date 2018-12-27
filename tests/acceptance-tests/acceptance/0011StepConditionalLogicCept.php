<?php
/*
 * Purpose: Test step conditional logic
 */

// @group step-approval

$I = new AcceptanceTester( $scenario );

$I->wantTo( 'Test step conditional logic' );

$I->loginAsAdmin();

$I->amOnPage( '/0011-step-conditional-logic' );
$I->fillField( 'Single Line', 'test' );
$I->fillField( 'Paragraph', 'test' );
$I->selectOption( 'User', '1' );
$I->click( 'Submit' );

$I->amOnWorkflowPage( 'Inbox' );
$I->waitforText( '0011 Step Conditional Logic', 3 );
$I->click( '0011 Step Conditional Logic' );

$I->waitforText( 'Approval if Created By ID1', 3 );
$I->see( 'Approval if Created By ID1', '.gravityflow-status-box' );
$I->dontSee( 'Approval if Created By ID2', '.gravityflow-status-box' );
$I->click( 'Approve' );

$I->waitforText( 'Approval if User Field ID1' );
$I->see( 'Approval if User Field ID1', '.gravityflow-status-box' );
$I->dontSee( 'Approval if User Field ID2', '.gravityflow-status-box' );
$I->click( 'Approve' );
$I->waitforText( 'Entry Approved' );


