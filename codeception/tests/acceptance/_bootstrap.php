﻿<?php
// Here you can initialize variables that will be available to your tests
\Codeception\Util\Autoload::registerSuffix('Page', __DIR__.DIRECTORY_SEPARATOR.'_pages');
class InitTest{
    /**
     * @var bool $loggedIn true if you logged in
     */
    protected static $LoggedIn;
    
    /**
     * @var string $text250 sample for filling field
     */
    public static $text250 = "Существуют разнообразные системы управления сайтом, среди которых встречаются платные и бесплатные, построенные по разным технологиям. Каждый сайт имеет панель управления, которая является только частью всей программы, достаточной для управления сайт";
    /**
     * @var string $text251 sample for filling field
     */
    public static $text251 = "Существуют разнообразные системы управления сайтом, среди которых встречаются платные и бесплатные, построенные по разным технологиям. Каждый сайт имеет панель управления, которая является только частью всей программы, достаточной для управления сайт1";
    /**
     * @var string $text500 sample for filling field
     */
    public static $text500 = "Генерация страниц по запросу. Системы такого типа работают на основе связки «Модуль редактирования База данных Модуль представления». Модуль представления генерирует страницу с содержанием при запросе на него, на основе информации из базы данных. Информация в базе данных изменяется с помощью модуля редактирования. Страницы заново создаются сервером при каждом запросе, что в свою очередь создаёт дополнительную нагрузку на системные ресурсы. Нагрузка может быть многократно снижена при использовани";
    /**
     * @var string $text501 sample for filling field
     */
    public static $text501 = "Генерация страниц по запросу. Системы такого типа работают на основе связки «Модуль редактирования База данных Модуль представления». Модуль представления генерирует страницу с содержанием при запросе на него, на основе информации из базы данных. Информация в базе данных изменяется с помощью модуля редактирования. Страницы заново создаются сервером при каждом запросе, что в свою очередь создаёт дополнительную нагрузку на системные ресурсы. Нагрузка может быть многократно снижена при использовании";
    /**
     * @var string $textSymbols sample for filling field
     */
    public static $textSymbols = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІабвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі,<.>?\/|~`!@#$%^&*(){}[]\'";:';
    
    
    public static function Login($I) {
        if(!self::$LoggedIn){
        $userName = 'ad@min.com';
        $password = 'admin';
        $I->wantTo('log in as admin');
        $I->amOnPage('/admin/login');
        $I->fillField('login', $userName);
        $I->fillField('password', $password);
        $I->click('.btn.btn-info');
        $I->waitForElement(".frame_nav");
        }
        self::$LoggedIn = TRUE;
    }
    
    
    public static function Loguot($I) {
        if(self::$LoggedIn){
        $I->amOnPage('/admin');
        $I->click(".my_icon.exit_ico");
        $I->waitForElement(".form_login.t-a_c");        
        }
        self::$LoggedIn=FALSE;
    } 
    
    /**
     * Clear cache work only at admin panel
     * @param AcceptanceTester $I Controller 
     */
    public static function ClearAllCach ($I){
        $I->click(NavigationBarPage::$System);
        $I->click(NavigationBarPage::$SystemClearAllCach);
//        $I->waitForElement(".alert.in.fade.alert-error", '30');
    }

}