<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks');
$I->click('.//*[@id="callbacks_all"]/table/tbody/tr[1]/td[3]/a');
$I->waitForElement('.//*[@id="editCallbackForm"]/div[2]/label');
$I->fillField('.//*[@id="editCallbackForm"]/div[3]/div/input', 'a');
$I->fillField('.//*[@id="editCallbackForm"]/div[4]/div/input', '1');
$I->fillField('.//*[@id="editCallbackForm"]/div[5]/div/textarea', 's');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Изменения сохранены');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField('.//*[@id="editCallbackForm"]/div[3]/div/input', 'a');
$I->seeInField('.//*[@id="editCallbackForm"]/div[4]/div/input', '1');
$I->seeInField('.//*[@id="editCallbackForm"]/div[5]/div/input', 's');
