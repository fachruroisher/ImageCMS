<?php
use \ProductsTester;

class CreateProductCest
{
    private $AllSymbolsCur, $MAINSYM, $AllIsoCur, $MainIso, $Cat;
    public function Autorization(ProductsTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage(ProductsPage::$URL);
        $I->waitForText("Создать товар", "10", ProductsPage::$CreateProductButton);
    }
    
    
    public function NamesInCreate(ProductsTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies');
        $kil=$I->grabClassCount($I, "btn btn-small btn-danger");
        $I->comment($kil);
        for ($j=1; $j<=$kil; $j++){
            $IsoCurAll[$j]=$I->grabTextFrom(".//*[@class='']/tr[$j]/td[3]");
            $I->comment("$IsoCurAll[$j]");
        }
        for ($i=1; $i<=$kil; $i++){
           $atribCheck = $I->grabAttributeFrom("//tbody/tr[$i]/td[5]/input","checked");
                if($atribCheck == TRUE){
                break;
            }
        }
        $this->MAINSYM=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($i));
        $this->MainIso=$I->grabTextFrom(CurrenciesPage::IsoCodeLine($i));
        $mainIsoCur=$I->grabTextFrom(".//*[@class='']/tr[$i]/td[3]");
        $I->comment("Main ISO Code: $this->MainIso");
        $I->comment("Main Currency Symbol: $this->MAINSYM");
        $I->click(CurrenciesPage::CurrencyNameLine("$i"));
        $I->waitForText('Редактирование валют');
        $I->fillField(CurrenciesPage::$Rate, '1');
        $I->click(CurrenciesPage::$CurrencyTemplateSelect);
        $I->click(CurrenciesPage::$CurrencyTemplateSelect.'/option[9]');
        $I->click(CurrenciesPage::$AmountDecimalsSelect);
        $I->click(CurrenciesPage::$AmountDecimalsSelect.'/option', '1');
        $I->wait('5');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
        
        $I->amOnPage("/admin/components/run/shop/categories/index");
        $I->wait(3);
        $I->clickAllElements($I,".btn.expandButton",3);        
        $text = $I->grabTextFromAllElements($I, "div.body_category div.row-category div.share_alt a.pjax");
            foreach ($text as $value) {
                $I->comment("$value");                
            }            
        $AllCat=  implode("_", $text);
        $I->comment($AllCat);        
        $AllCat=  str_replace(array('-',' ','_'),"", $AllCat);
        $I->comment($AllCat);
        $firstCat=$I->grabTextFrom(".//*[@id='category']/div[2]/div/div[1]/div/div[3]/div/a");
        $I->comment("FirstCategory: $firstCat");
        $I->amOnPage(ProductsPage::$URL);        
        $I->click(ProductsPage::$CreateProductButton);
        $I->waitForElement(ProductsPage::$ImageIcon);
        $I->see('Создание товара', ".//*[@id='mainContent']/section/div/div[1]/span[2]");
        $I->see('Товар', ProductsPage::$ProductButton);
        $I->see('Настройки', ProductsPage::$PreferencesButton);
        $I->see('Название товара:', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[1]/label');
        $I->see('*', "//*[@id='parameters']/div/table/tbody/tr/td/div/div[1]/div[1]/label/span");
        $I->see('Старая цена:', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[3]/label');
        $I->see($this->MAINSYM, '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[3]/div/b');
        $I->see('Статус:', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[2]/label');
        $I->see('Товар:', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[4]/label');
        $I->see('Название варианта товара', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[4]/div/div/table/thead/tr/th[2]');
        $I->see('Цена', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[4]/div/div/table/thead/tr/th[3]');
        $I->see('*', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[4]/div/div/table/thead/tr/th[3]/span');
        $I->see('Валюта', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[4]/div/div/table/thead/tr/th[4]');
        $I->seeOptionIsSelected(ProductsPage::$Currency, $mainIsoCur);
        $I->click(ProductsPage::$Currency);
        for ($k=1; $k<=$kil; $k++){
            $IsoCur[$k]=$I->grabTextFrom(ProductsPage::$Currency."/option[$k]");
            $I->comment("$IsoCurAll[$k]");
        }
        $I->assertEquals($IsoCur, $IsoCurAll);
        $I->see('Артикул', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[4]/div/div/table/thead/tr/th[5]');
        $I->see('Количество', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[4]/div/div/table/thead/tr/th[6]');
//        $I->see('Фото', '//*[@id="parameters"]/div/div[1]/div[4]/div/div/table/thead/tr/th[1]');
        $I->see('Добавить вариант', ProductsPage::$AddVariantButton);
        $I->see('Название бренда:', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[2]/label');
        $I->see('Не указано', ProductsPage::$BrandName.'/a/span');
        $I->click(ProductsPage::$BrandName);
        $kilBrands=$I->grabClassCount($I, "active-result");
        $I->comment("Amount Brands: $kilBrands");
        for ($h=2; $h<=$kilBrands; $h++){
            $BrandsInSelectMenu[$h]=$I->grabTextFrom(ProductsPage::$BrandName."/div/ul/li[$h]");
            $I->comment("$BrandsInSelectMenu[$h]");
        }
        $I->click(ProductsPage::$BrandName);
        $I->see('Категория:', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[3]/label');
        $I->see($firstCat, ProductsPage::$Category.'/a/span');
        $I->click(ProductsPage::$Category);
        $I->wait('1');
        $kilCat=$I->grabClassCount($I, "active-result");
        $kilCategory=$kilCat-$kilBrands;
        $I->comment("Amount Category: $kilCategory");
        for ($y=1; $y<=$kilCategory; $y++){
            $CategoryInSelectMenu[$y]=$I->grabTextFrom(ProductsPage::$Category."/div/ul/li[$y]");
            $I->comment("$CategoryInSelectMenu[$y]");
        }
        $CategoryInMenu=  implode(" ", $CategoryInSelectMenu);
        $I->comment($CategoryInMenu);
        $CategoryInMenu=  str_replace(array('-',' '),"",$CategoryInMenu);
        $I->comment($CategoryInMenu);
        $I->assertEquals($CategoryInMenu, $AllCat);
        $I->click(ProductsPage::$Category);
        $I->see('Дополнительные категории:', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[4]/label');
        $I->seeInField(ProductsPage::$AdditionalCategory.'/ul/li/input', 'Выберите категории');
        $I->click(ProductsPage::$AdditionalCategory);
        for ($x=1; $x<=$kilCategory; $x++){
            $CategoryInSelectMenu1[$x]=$I->grabTextFrom(ProductsPage::$AdditionalCategory."/div/ul/li[$x]");
            $I->comment("$CategoryInSelectMenu1[$x]");
        }
        $CategoryInMenu1=  implode(" ", $CategoryInSelectMenu1);
        $I->comment($CategoryInMenu1);
        $CategoryInMenu1=  str_replace(array('-',' '),"",$CategoryInMenu1);
        $I->comment($CategoryInMenu1);
        $I->assertEquals($CategoryInMenu1, $AllCat);  
        $I->click(ProductsPage::$AdditionalCategory);
        $I->see('Краткое описание:', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[5]/label');
        $I->see('Полное описание:', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[6]/label');
        $I->click(ProductsPage::$PreferencesButton);
        $I->waitForElement(ProductsPage::$MetaTitle);
        $I->see('Дополнительные настройки', '//*[@id="settings"]/div/div[2]/table/thead/tr/th');
        $I->see('Разрешить комментирование:', '//*[@id="settings"]/div/div[2]/table/tbody/tr/td/div/div/div/div[1]/label');
        $I->see('Да', ProductsPage::Comments('1'));
        $I->see('Нет', ProductsPage::Comments('2'));
        $activeRadioBut=$I->grabAttributeFrom(ProductsPage::Comments('1')."/span/input", 'checked');
        $I->comment("$activeRadioBut");
        $I->assertEquals($activeRadioBut, 'true');
        $I->see('Дата создания:', '//*[@id="settings"]/div/div[2]/table/tbody/tr/td/div/div/div/div[2]/label');
        $I->click(ProductsPage::$DateOfCreate);
        $I->seeElement(".//*[@id='ui-datepicker-div']");
        $I->see('Формат даты: гггг-мм-дд чч:мм:сс', '//*[@id="settings"]/div/div[2]/table/tbody/tr/td/div/div/div/div[2]/div/p');        
        $I->see('Главный шаблон:', '//*[@id="settings"]/div/div[2]/table/tbody/tr/td/div/div/div/div[3]/label');
        $I->see('Основной шаблон товара. По-умолчанию product.tpl', '//*[@id="settings"]/div/div[2]/table/tbody/tr/td/div/div/div/div[3]/div/p');
        
        $I->see('Мета-данные', '//*[@id="settings"]/div/div[1]/table/thead/tr/th');
        $I->see('URL:', '//*[@id="settings"]/div/div[1]/table/tbody/tr/td/div/div/div[1]/label');
        $I->seeElement(ProductsPage::$AutoSelectButton);
        $I->see('Meta Title', '//*[@id="settings"]/div/div[1]/table/tbody/tr/td/div/div/div[2]/label');
        $I->see('Meta Description', '//*[@id="settings"]/div/div[1]/table/tbody/tr/td/div/div/div[3]/label');
        $I->see('Meta Keywords', '//*[@id="settings"]/div/div[1]/table/tbody/tr/td/div/div/div[4]/label');
        $I->see('Вернуться', ProductsPage::$GoBackButton);
        $I->see('Создать', ProductsPage::$SaveButton);
        $I->see('Создать и выйти', ProductsPage::$SaveAndExitButton);
    }
    
    public function CurrencySymbol(ProductsTester $I)
    {
        $I->amOnPage(CurrenciesPage::$URL);
        $rows = $I->grabCCSAmount($I,".btn.btn-small.btn-danger");
        $I->comment("$rows");
        for($j=1; $j<=$rows; ++$j){
            $text[$j]=$I->grabTextFrom(CurrenciesPage::SymbolCurrencyLine($j));
            $iso[$j]=$I->grabTextFrom(CurrenciesPage::IsoCodeLine($j));
            $I->comment($text[$j]);
            $I->comment($iso[$j]);            
        }
        $this->AllSymbolsCur=  implode(" ", $text);
        $I->comment($this->AllSymbolsCur);
        $this->AllIsoCur= implode(" ", $iso);
        $I->comment($this->AllIsoCur);
    }
    
    
    public function RequiredFieldsSaveButtonInCreate(ProductsTester $I)
    {
        $I->amOnPage(ProductsPage::$URL);
        $I->click(ProductsPage::$CreateProductButton);
        $I->waitForText('Создание товара');
        $I->click(ProductsPage::$SaveButton);
        $I->see('Это поле обязательное.', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[1]/div/label');
        $I->see('Это поле обязательное.', '//*[@id="ProductVariantRow_0"]/td[3]/label');        
        $I->click(ProductsPage::$GoBackButton);
        $I->waitForText('Список товаров');
        InitTest::ClearAllCach($I);
    }
    
    
    public function RequiredFieldsSaveAndExitButtonInCreate(ProductsTester $I)
    {
        $I->amOnPage(ProductsPage::$URL);
        $I->click(ProductsPage::$CreateProductButton);
        $I->waitForText('Создание товара');
        $I->click(ProductsPage::$SaveAndExitButton);
        $I->see('Это поле обязательное.', '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[1]/div/label');
        $I->see('Это поле обязательное.', '//*[@id="ProductVariantRow_0"]/td[3]/label');        
        $I->click(ProductsPage::$GoBackButton);
        $I->waitForText('Список товаров');
    }
    
     /**
     * @guy ProductsTester\ProductsSteps
     */
    
    public function CreateProduct1(ProductsTester\ProductsSteps $I)
    {
        $name=$I->GenerateNameProduct();
        $price='100';
        $ret=$I->CreateProduct($name, $nameVariant=null, $price);
            foreach($ret as $key => $value) 
            { 
               $I->comment("$value");
                if($value)  $I->comment("$key: $value");
            }
        $amount='1';
        $brand='Не указано';
        $addCat1='Выберите дополнительные категории';
//        $comment='Нет';
//        $comment='Да';
        $I->CheckInFields($name, $nameVariant=null, $price, null,null,null,$currency=null, $articul=null, $amount,$image2=null, $brand, 
                $category=null, null, $shortDesc=null, $fullDesc=null, $comment='yes');
        $I->click(ProductsPage::$ProductButton);
        $I->seeInField(\ProductsPage::$AdditionalCategory.'/ul/li/input', $addCat1);
        $I->see('Свойства', ProductsPage::$PropertyButton);
        $I->see('Дополнительные фотографии', ProductsPage::$ImagesButton);
        $I->see('Наборы', ProductsPage::$KitsProductButton);
        $I->see('Аксессуары', ProductsPage::$AccessoriesButton);
        $I->see('Настройки', ProductsPage::$PrefButtonEditing);
        $I->click(ProductsPage::$GoBackButton);
        $I->CheckInListLanding($name, $category=null, $articul=null, $price, $this->MAINSYM);
        $I->CheckInFrontEnd($name, $category=null, $articul=null, $price, $this->MAINSYM, null,null,null,null,null,null,null,$comment='yes');
    }
        
    /**
     * @guy ProductsTester\ProductsSteps
     */
    
    public function CreateProduct2(ProductsTester\ProductsSteps $I)
    {
        $name='Sony Television';
        $price='333';
        $currency='2';
        $articul='1';
        $amount='2';
        $image2='';
        $brand='2';
        $category='3';
        $addCat='5';
        $oldPrice='406';
        $I->amOnPage("/admin/components/run/shop/categories/index");
        $I->wait(3);
        $I->clickAllElements($I,".btn.expandButton",3);        
        $text = $I->grabTextFromAllElements($I, "div.body_category div.row-category div.share_alt a.pjax");
            foreach ($text as $key =>$value) {
                $I->comment("$value");
                if($value)  $I->comment("$key: $value");
            }             
        $I->comment("$text[2]");
        $I->comment("$text[4]");
        $comment='no';
        $ret=$I->CreateProduct($name, $nameVariant=null, $price, null, null, null,$currency, $articul, $amount, 
                $image2, $brand, $category, $addCat, $shortDesc=null, 
                $fullDesc=null, $comment, $dateCreate=null, $oldPrice);
        foreach($ret as $key => $value) 
            { 
               $I->comment("$value");
                if($value)  $I->comment("$key: $value");
            }
        $I->CheckInFields($name, $nameVariant=null, $price, null, null, null, $this->MainIso, $articul, $amount, $ret["image"], $ret["brand"], 
                $ret["category"], $ret["addCategory"], $shortDesc=null, $fullDesc=null, $comment);
        $im2=$I->grabAttributeFrom(".//*[@id='ProductVariantRow_0']/td[1]/div/div/img", 'src');
        $I->click(ProductsPage::$GoBackButton);
        $I->CheckInListLanding($name, $text[2], $articul, $price, $this->MAINSYM);
        $I->CheckInFrontEnd($name, $text[2], $articul, $price, $this->MAINSYM, $ret["brand"], $ret["image"], null,null,null,$shortDesc=null, $fullDesc=null, $comment, $oldPrice);
    }
    
    
    /**
     * @guy ProductsTester\ProductsSteps
     */
    
    public function CreateProduct3(ProductsTester\ProductsSteps $I)
    {
        $I->amOnPage(ProductsPage::$URL);
        InitTest::changeTextAditorToNative($I);
        $name=$I->GenerateNameProduct();
        $price='100';
        $currency='1';
        $articul='w33в1';
        $amount='8';        
        $brand='2';
        $category='7';           
        $shortDesc='HTC One SV c легкостью справится с твоим напряженным графиком благодаря сверхбыстрому двухъядерному процессору с частотой 1,2 ГГц.';
        $fullDesc='PHP является одним из важных моментов в вопросе безопасности сервера, поскольку PHP-скрипты могут манипулировать файлами и каталогами на диске. В связи с этим существуют конфигурационные настройки, указывающие, какие файлы могут быть доступны и какие операции с ними можно выполнять. Необходимо проявлять осторожность, поскольку любой из файлов с соответствующими правами доступа может быть прочитан каждым, кто имеет доступ к файловой системе. Поскольку в PHP изначально предполагался полноправный пользовательский доступ к файловой системе, можно написать скрипт, который позволит читать системные файлы, такие как /etc/passwd, управлять сетевыми соединениями, отправлять задания принтеру, и так далее. Как следствие вы всегда должны быть уверены в том, что файлы, которые вы читаете или модифицируете, соответствуют вашим намерениям.';
        $url='product-descripti';
        $I->amOnPage(CurrenciesPage::$URL);
        $I->click(CurrenciesPage::CurrencyNameLine('1'));
        $I->waitForText('Редактирование валют');
        $rate=$I->grabValueFrom(CurrenciesPage::$Rate);
        $I->click(CurrenciesPage::$CurrencyTemplateSelect);
        $I->click(CurrenciesPage::$CurrencyTemplateSelect.'/option[9]');
        $I->wait('5');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText('Список валют');
        $price2=  round($price/$rate);
        
        $I->amOnPage("/admin/components/run/shop/categories/index");
        $I->wait(3);
        $I->clickAllElements($I,".btn.expandButton",3);        
        $text = $I->grabTextFromAllElements($I, "div.body_category div.row-category div.share_alt a.pjax");
            foreach ($text as $key =>$value) {
                $I->comment("$value");
                if($value)  $I->comment("$key: $value");
            }             
        $I->comment("$text[6]");       
        $ret=$I->CreateProduct($name, $nameVariant=null, $price, $hotstatus=null, null, null, $currency, $articul, $amount, 
                $image2=null, $brand, $category, $addCat=null, $shortDesc, 
                $fullDesc, $comment='no', $dateCreate=null, $oldPrice=null, $mainTemp=null, $url);
        foreach($ret as $key => $value) 
            { 
               $I->comment("$value");
                if($value)  $I->comment("$key: $value");
            }
        $I->CheckInFields($name, $nameVariant=null, $price, null, null, null, $this->AllIsoCur[1], $articul, $amount,$image2=null, $ret["brand"], 
                $ret["category"], $addCat=null, $shortDesc, $fullDesc, $comment='no',$date=null,$oldPrice=null,$mainTemp=null,$url);
        $I->click(ProductsPage::$GoBackButton);
        $I->CheckInListLanding($name, $text[6], $articul, $price, $this->AllSymbolsCur[1]);
        $I->CheckInFrontEnd($name, $text[6], $articul, $price2, $this->MAINSYM, $ret["brand"], null,null,null,null, $shortDesc, $fullDesc, $comment='no', $oldPrice=null,$url);
    }
    
    
     /**
     * @guy ProductsTester\ProductsSteps
     */
    
    public function CreateProduct4_1Symbol(ProductsTester\ProductsSteps $I)
    {
        $name='a';
        $price='3';
        $hotStatus='';
        $articul='1';
        $amount='2';
        $shortDesc='d';
        $fullDesc='g';
        $oldPrice='4';
        $mainTemp='s';
        $url='f';
        $mTitle='g';
        $mDesc='j';
        $mKeywords='w';
        $I->amOnPage("/admin/components/run/shop/categories/index");
        $I->wait(3);
        $I->clickAllElements($I,".btn.expandButton",3);        
        $text = $I->grabTextFromAllElements($I, "div.body_category div.row-category div.share_alt a.pjax");
            foreach ($text as $key =>$value) {
                $I->comment("$value");
                if($value)  $I->comment("$key: $value");
            } 
        $ret=$I->CreateProduct($name, $nameVariant=null, $price,$hotStatus,null,null,null,$articul,$amount,null,null,null,null,$shortDesc,$fullDesc,$comment='no',
                null,$oldPrice,$mainTemp,$url,$mTitle,$mDesc,$mKeywords);
        $brand='Не указано';        
        $I->CheckInFields($name, null, $price, $hotStatus, null, null, $this->MainIso, $articul, $amount, null, $brand, $text[0], null,
                $shortDesc, $fullDesc, $comment='no', null, $oldPrice, $mainTemp,$url,$mTitle,$mDesc,$mKeywords);
        $I->click(ProductsPage::$GoBackButton);
        $I->CheckInListLanding($name, $text[0], $articul, $price, $this->MAINSYM);
        $I->CheckInFrontEnd($name, $text[0], $articul, $price, $this->MAINSYM, null, null, $hotStatus, null, null, $shortDesc, $fullDesc, $comment='no', $oldPrice, $url);
    }
        
     /**
     * @guy ProductsTester\ProductsSteps
     */
    
    public function CreateProduct5_128Symbols(ProductsTester\ProductsSteps $I)
    {
        $name='Необходимо выбрать организационно-правовую форму  предприятия, провести все переговоры с потенциальными партнёрами и подготовить';
        $price='3';//max=double(20,5)
        $saleStatus='';
        $articul='Необходимо 1234567 организационно-правовую форму  предприятия, провести все переговоры с потенциальными партнёрами и подготовить';//255
        $amount='123456';//max=11
        $shortDesc='В чем не откажешь англосаксам, так в их очень сильном и очень специфическом чувстве юмора. По-русски говорят «задрать нос», а по';
        $fullDesc='быть слишком большим для собственных бриджей.Если учесть,что бриджами назывались обтягивающие штанишки для занятий верховой ездо';
        $oldPrice='4';//float(10,2)
        $mainTemp='sdjfosijffddg65656jrfjdj5454564jdfkdfdkfkfFGHFHgdgrty6567568654566666645645645645646464564564564564646456fghfhghfhhjghjghjghjggg';
        $url='Itwillgive_us_three2or%four_days atbesfdgs_jfjjkkkkkkkkkkkkdg6788668ggg_gdjkdfdGDF8989kfcjkccjjjjjjjjjjjjjjjjjj7777777777745w';
        $mTitle='Как правильно написать тайтл. Как правильно написать тайтл. Как правильно написать тайтл. Как правильно написать тайтл. Как прав';
        $mDesc='как правильно заполнять теги meta keywords . Явно, устарели, так как на мета-теги поисковики уже давно внимания не обращают юююю';
        $mKeywords='В случае, если фраза из keywords не была расценена как спамная и при этом она встречается на странице,то Яндекс может это учес т';
        $I->amOnPage("/admin/components/run/shop/categories/index");
        $I->wait(3);
        $name2= substr($name, 0, 188);
        $I->clickAllElements($I,".btn.expandButton",3);        
        $text = $I->grabTextFromAllElements($I, "div.body_category div.row-category div.share_alt a.pjax");
            foreach ($text as $key =>$value) {
                $I->comment("$value");
                if($value)  $I->comment("$key: $value");
            } 
        $ret=$I->CreateProduct($name, null, $price,null,null,$saleStatus,null,$articul,$amount,null,null,null,null,$shortDesc,$fullDesc,$comment='no',
                null,$oldPrice,$mainTemp,$url,$mTitle,$mDesc,$mKeywords);
        $I->CheckInFields($name, null, $price, null, null, $saleStatus, $this->MainIso, $articul, $amount, null, null, null, null,
                $shortDesc, $fullDesc, $comment='no', null, $oldPrice, $mainTemp,$url,$mTitle,$mDesc,$mKeywords);
        $I->click(ProductsPage::$GoBackButton);
        $I->CheckInListLanding($name2.'...', null, $articul, $price, $this->MAINSYM);
        $I->CheckInFrontEnd($name, null, $articul, $price, $this->MAINSYM, null, null, null, null, $saleStatus, $shortDesc, $fullDesc, $comment='no', $oldPrice, $url);
    }
    
     /**
     * @guy ProductsTester\ProductsSteps
     */
    
    public function CreateProduct6_250Symbols(ProductsTester\ProductsSteps $I)
    {
        $name='Если от неосторожного обращения на дверном полотне возникли потёртости или царапины — не расстраивайтесь. Повреждения можно частично исправить своими руками. Для этого используются подкрашенные мебельные либо прозрачные лаки, твердые цветные восковые.';
        $price='3';//max=double(20,5)
        $newStatus='';
        $articul='Необходимо 55512345555 5555555675555 апрапорганизационно-правовую форму предприятия, провести все переговоры с потенциальными партнёрами и подготовить апувпапв222222 343444444444444444444 Необходимо рганизационно-правовую форму 5565665567567575675676';//255
        $amount='123456';//max=11
        $shortDesc='Можно приобрести в отделах бытовой химии.Мелкие царапины на двери с отделкой искусственным шпоном восстанавливаются полиролью,в которую добавляют краситель в цвет реставрируемого изделия,например,из качественных акварельных красок.Большие повреждения';
        $fullDesc='(глубокие и широкие царапины и обрывы от удара) полностью восстановить невозможно. Можно только сделать их менее заметными тем же способом с полиролью или закрасить их близкой по цвету краской. Если от неосторожного обращения на дверном полотне вознb';
        $oldPrice='4';//float(10,2)
        $mainTemp='dfg';
//        $mainTemp='sdjfosijffddg65656jrfjdj5454564jdfkdfdkfkfFGHFHgdgrty6567568654566666645645645645646464564564564564646456fghfhghfhhjghjghjghjgggsdjfosijffddg65656jrfjdj5454564jdfkdfdkfkfFGHFHgdgrty6567568654566666645645645645646464564564564564646456fghfhghfhhjghjghj';
        $url='uuuuuuuuuuuthtjklfjhjfklhjhthttshrththrhotkththyt%jm$fgfg68hgjgjyujy7685+uhjyuj=yhjuyj-hjhj_hjujhjhjfgfdgdfgd556667_ggfgfgffgfhgh444444444444444444444498fghgggggggggggggggggggggjdf7dhddddddddddddddddddddddddddd_gggggggfhjddddddddddddj6667777777wwww66';
        $mTitle='Как видно - слишком много "если", "может", "возможно". В то же время, как обратный эффект - спамное пичканье всевозможных ключевых фраз в keywords "намного более возможней" может привести к отрицательному эффекту, когда перенасыщенный ключевиками ввв';
        $mDesc='Как видно - слишком много "если", "может", "возможно". В то же время, как обратный эффект - спамное пичканье всевозможных ключевых фраз в keywords "намного более возможней" может привести к отрицательному эффекту, когда перенасыщенный ключевиками ввв';
        $mKeywords='Как видно - слишком много "если", "может", "возможно". В то же время, как обратный эффект - спамное пичканье всевозможных ключевых фраз в keywords "намного более возможней" может привести к отрицательному эффекту, когда перенасыщенный ключевиками ввв';
        $I->amOnPage("/admin/components/run/shop/categories/index");
        $I->wait(3);
        $name2= substr($name, 0, 188);
        $I->clickAllElements($I,".btn.expandButton",3);        
        $text = $I->grabTextFromAllElements($I, "div.body_category div.row-category div.share_alt a.pjax");
            foreach ($text as $key =>$value) {
                $I->comment("$value");
                if($value)  $I->comment("$key: $value");
            } 
        $ret=$I->CreateProduct($name, null, $price,null,$newStatus,null,null,$articul,$amount,null,null,null,null,$shortDesc,$fullDesc,$comment='no',
                null,$oldPrice,$mainTemp,$url,$mTitle,$mDesc,$mKeywords);
        $I->CheckInFields($name, null, $price, null, $newStatus, null, $this->MainIso, $articul, $amount, null, null, null, null,
                $shortDesc, $fullDesc, $comment='no', null, $oldPrice, $mainTemp,$url,$mTitle,$mDesc,$mKeywords);
        $I->click(ProductsPage::$GoBackButton);
        $I->CheckInListLanding($name2.'...', null, $articul, $price, $this->MAINSYM);
        $I->CheckInFrontEnd($name, null, $articul, $price, $this->MAINSYM, null, null, null, $newStatus, null, $shortDesc, $fullDesc, $comment='no', $oldPrice, $url);
    }
    
     /**
     * @guy ProductsTester\ProductsSteps
     */
    
    public function CreateProduct7_255Symbols(ProductsTester\ProductsSteps $I)
    {
        $name='Как утверждает производитель эта игрушка работает на энергии человеческого тела, она может зависать в воздухе и крутится вокруг его тела за счет энергии которую он создает.Только по мановению ваших рук летающая тарелка НЛО будет парить в воздухе. ghgh ggd';
        $price='3';//max=double(20,5)
        $saleStatus='';
        $articul='6478347894373894777493478 hfduyfguyguygygufduuuuuuuuuuuuuuuuuuuuudyyyf(00?==;hodfjkndghj56745+_Gfghfhfkdkjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjgggggggggggggg666666*8fgkjuhukgvuyxhcfvxx+gfgjfjfjffgggggggggg111113454545645645trrtgdrfdjh222jsjsjs5dfdfd555555555ddddd';//255
        $amount='123456';//max=11
        $shortDesc='В чем не откажешь англосаксам, так в их очень сильном и очень специфическом чувстве юмора. По-русски говорят «задрать нос», а по';
        $fullDesc='быть слишком большим для собственных бриджей.Если учесть,что бриджами назывались обтягивающие штанишки для занятий верховой ездо';
        $oldPrice='4';//float(10,2)
        $mainTemp='dfd';
//        $mainTemp='sdjfosijffddg65656jrfjdj5454564jdfkdfdkfkfFGHFHgdgrty6567568654566666645645645645646464564564564564646456fghfhghfhhjghjghjghjgggsdjfosijffddg65656jrfjdj5454564jdfkdfdkfkfFGHFHgdgrty6567568654566666645645645645646464564564564564646456fghfhghfhhjghjghjghjgg';
        $url='uuuuuuuuuuuthtjklfjhjfklhjhthttshrththrhotkththyt%jm$fgfg68hgjgjyujy7685+uhjyuj=yhjuyj-hjhj_hjujhjhjfgfdgdfgd556667_ggfgfgfdffgfhgh444444444444444444444498fghgggggggggggggggggggggjdf7dhdddddddddddd33ddd34dddddddddddd_gggggggfhjddddddddddddj666777777753434';
        $mTitle='Take advantage of all legitimate opportunities to score keyword credit, even when the payoff is relatively low. Fill in this tag`s text with relevant keywords and phrases that describe that page`s content.When creating keyword text, remember the following';
        $mDesc='Choose words that may be secondary keyword terms and even include a few, commonly seen typographical errors of primary keywords, just for good measure Limit your keyword and key phrase text, separated by commas, to no more than 874 characters Don`t repeat';
        $mKeywords='tags keyword attribute is not the page rank panacea it once was back in the prehistoric days of Internet search. It was abused far too much and lost most of its cachet. But theres no need to ignore the tag. Take advantage of all legitimate opportunities .';
        $I->amOnPage("/admin/components/run/shop/categories/index");
        $I->wait(3);
        $name2= substr($name, 0, 186);
        $I->clickAllElements($I,".btn.expandButton",3);        
        $text = $I->grabTextFromAllElements($I, "div.body_category div.row-category div.share_alt a.pjax");
            foreach ($text as $key =>$value) {
                $I->comment("$value");
                if($value)  $I->comment("$key: $value");
            } 
        $ret=$I->CreateProduct($name, null, $price,null,null,$saleStatus,null,$articul,$amount,null,null,null,null,$shortDesc,$fullDesc,$comment='no',
                null,$oldPrice,$mainTemp,$url,$mTitle,$mDesc,$mKeywords);
        $I->CheckInFields($name, null, $price, null, null, $saleStatus, $this->MainIso, $articul, $amount, null, null, null, null,
                $shortDesc, $fullDesc, $comment='no', null, $oldPrice, $mainTemp,$url,$mTitle,$mDesc,$mKeywords);
        $I->click(ProductsPage::$GoBackButton);
        $I->CheckInListLanding($name2.'...', null, $articul, $price, $this->MAINSYM);
        $I->CheckInFrontEnd($name, null, $articul, $price, $this->MAINSYM, null, null, null, null, $saleStatus, $shortDesc, $fullDesc, $comment='no', $oldPrice, $url);
    }
    
     /**
     * @guy ProductsTester\ProductsSteps
     */
    
    public function CreateProduct8_256Symbols(ProductsTester\ProductsSteps $I)
    {
        $name='Как-то поздно вечером я сидел в машине напротив Колумбийского Университета, ждал свою жену . Слушал интервью по радио. И вот ведущий задаёт вопрос: «Вам исполнилось (12353473) уже 75 лет, есть у вас совет для нашей аудитории, как подготовиться к старости?»';
        $price='3';//max=double(20,5)
        $saleStatus='';
        $articul='2353625326353625326532635263527667878787687678к6у78к6у87а6кп87па67в786666666666666тььььььььььььььььььььььалдППАВА;4палллаааааааааааааааааа12321321123ввааттвтв77777777888888888888888888888888090909090090994848888888аеорипекоркиеопкпл443434344344440909045454';//255
        $articul2='2353625326353625326532635263527667878787687678к6у78к6у87а6кп87па67в786666666666666тььььььььььььььььььььььалдППАВА;4палллаааааааааааааааааа12321321123ввааттвтв77777777888888888888888888888888090909090090994848888888аеорипекоркиеопкпл44343434434444090904545';
        $amount='123456';//max=11
        $shortDesc='Раздражённый голос ответил: «И почему все меня теперь спрашивают о старости?!»Я узнал голос Джона Кейджа, композитора и философа, который оказал серьезное влияние на развитие музыки и на становление таких людей, как Джаспер Джонс и Мерс Каннингем.Я немного';
        $fullDesc='И вот он отвечает: «Хотя, знаете, я дам совет, как подготовиться к старости. Никогда не нанимайтесь на работу. Потому что тогда кто-нибудь в один прекрасный день сможет вас уволить. И вот вы не готовы к старости. Что касается меня, то ничего не меняется с.';
        $oldPrice='4';//float(10,2)
        $mainTemp='dfd';
//        $mainTemp='sdjfosijffddg65656jrfjdj5454564jdfkdfdkfkfFGHFHgdgrty6567568654566666645645645645646464564564564564646456fghfhghfhhjghjghjghjgggsdjfosijffddg65656jrfjdj5454564jdfkdfdkfkfFGHFHgdgrty6567568654566666645645645645646464564564564564646456fghfhghfhhjghjghjghjgg';
        $url='ddddddddddddddddddddddddddddddddfffffffffffffffffffffffffffffffffffffffffffffssssssssssssssssssssssssssssssssssssssssssssssssgggggggggggggggggggggggggggggggggggggggggggggggg_ddddddddddddddddddddddddddddddddddd-rfffffffffffffffff_ddddddbbbbbbbbbbbvdfvdfdfdd';
        $url2='ddddddddddddddddddddddddddddddddfffffffffffffffffffffffffffffffffffffffffffffssssssssssssssssssssssssssssssssssssssssssssssssgggggggggggggggggggggggggggggggggggggggggggggggg_ddddddddddddddddddddddddddddddddddd-rfffffffffffffffff_ddddddbbbbbbbbbbbvdfvdfdfd';
        $mTitle='Take advantage of all legitimate opportunities to score keyword credit, even when the payoff is relatively low. Fill in this tag`s text with relevant keywords and phrases that describe that page`s content.When creating keyword text, remember the following1';
        $mDesc='Choose words that may be secondary keyword terms and even include a few, commonly seen typographical errors of primary keywords, just for good measure Limit your keyword and key phrase text, separated by commas, to no more than 874 characters Don`t repeat1';
        $mKeywords='tags keyword attribute is not the page rank panacea it once was back in the prehistoric days of Internet search. It was abused far too much and lost most of its cachet. But theres no need to ignore the tag. Take advantage of all legitimate opportunities 1.';
        $mTitle2='Take advantage of all legitimate opportunities to score keyword credit, even when the payoff is relatively low. Fill in this tag`s text with relevant keywords and phrases that describe that page`s content.When creating keyword text, remember the following';
        $mDesc2='Choose words that may be secondary keyword terms and even include a few, commonly seen typographical errors of primary keywords, just for good measure Limit your keyword and key phrase text, separated by commas, to no more than 874 characters Don`t repeat';
        $mKeywords2='tags keyword attribute is not the page rank panacea it once was back in the prehistoric days of Internet search. It was abused far too much and lost most of its cachet. But theres no need to ignore the tag. Take advantage of all legitimate opportunities 1';
        $I->amOnPage("/admin/components/run/shop/categories/index");
        $I->wait(3);
        $name2= substr($name, 0, 182);
        $I->clickAllElements($I,".btn.expandButton",3);        
        $text = $I->grabTextFromAllElements($I, "div.body_category div.row-category div.share_alt a.pjax");
            foreach ($text as $key =>$value) {
                $I->comment("$value");
                if($value)  $I->comment("$key: $value");
            } 
        $ret=$I->CreateProduct($name, null, $price,null,null,$saleStatus,null,$articul,$amount,null,null,null,null,$shortDesc,$fullDesc,$comment='no',
                null,$oldPrice,$mainTemp,$url,$mTitle,$mDesc,$mKeywords);
        $I->CheckInFields($name, null, $price, null, null, $saleStatus, $this->MainIso, $articul2, $amount, null, null, null, null,
                $shortDesc, $fullDesc, $comment='no', null, $oldPrice, $mainTemp,$url2,$mTitle2,$mDesc2,$mKeywords2);
        $I->click(ProductsPage::$GoBackButton);
        $I->CheckInListLanding($name2.'...', null, $articul2, $price, $this->MAINSYM);
        $I->CheckInFrontEnd($name, null, $articul2, $price, $this->MAINSYM, null, null, null, null, $saleStatus, $shortDesc, $fullDesc, $comment='no', $oldPrice, $url2);
    }
    
    /**
     * @guy ProductsTester\ProductsSteps
      */
    
    public function CreateProduct9_500Symbols(ProductsTester\ProductsSteps $I)
    {
        $name='За повідомленням пресслужби ДПСУ,впродовж доби прикордонники відділу прикордонної служби Красна Талівка(Луганська область) тричі фіксували спрацювання мін,встановлених російськими терористами на ділянці відповідальності відділу поблизу кордону.В одному із випадків на міні підірвалася жителька одного із прикордонних сіл.Обставини вибухів ще у двох випадках зясовуються,сказано у повідомленні.Це може свідчити про активізацію мінної війни на даній ділянці та поновлення спроб боку російських найманців відтіснити прикордонників від лінії кордону';
        $price='3';//max=double(20,5)
        $saleStatus='';
        $articul=' 5555ddddd ';//255
        $articul2='5555ddddd';
        $amount='123456';//max=11
        $shortDesc='Вселенское пространство во все столетия беспокоило умы Людей! 1234435-34-3434_7 У вас в руках все тайны Космоса! Каждая десятиминутная часть данного альманаха увлекательно рассказывает о нашей космической обители, показывает ясный, реалистический и превосходно проиллюстрированный рассказ о планетах и спутниках, о Солнце, о галактике и Вселенной за ее рубежами. Превосходный текст, академическая выверенность, первоклассный видеоряд формируют и обучают самим основам познаний о космосе и астрономии.';
        $fullDesc='Пишу з передової, коротко. Прошу репосту. Народні депутати, громадські активісти, підключайтеся терміново. Зараз у Житомирському суді обирають запобіжний захід Кашубі Віталію. Це наш кращий розвідник, командир диверсійної групи Добровольчого Укр. Корпусу. Знищив сотні - не перебільшую - озброєних сепаратистів . Його схопили під час короткотривалого перебування в Києві, привезли на суд у Житомир і хочуть посадити під домашній арешт з браслетом . Суть справи: кілька місяців тому попався в Житомирі - віз нам на фронт боєприпаси.';
        $oldPrice='4';//float(10,2)
//        $mainTemp='dfjd!@##$#%&(*_|98763></,.:`~;d';
//        $mainTemp='sdjfosijffddg65656jrfjdj5454564jdfkdfdkfkfFGHFHgdgrty6567568654566666645645645645646464564564564564646456fghfhghfhhjghjghjghjgggsdjfosijffddg65656jrfjdj5454564jdfkdfdkfkfFGHFHgdgrty6567568654566666645645645645646464564564564564646456fghfhghfhhjghjghjghjgg';
        $url='3434';
        $mTitle='Take advantage';
        $mDesc='Choose';
        $mKeywords='it once was back';
        $I->amOnPage("/admin/components/run/shop/categories/index");
        $I->wait(3);
        $name2= substr($name, 0, 186);
        $I->clickAllElements($I,".btn.expandButton",3);        
        $text = $I->grabTextFromAllElements($I, "div.body_category div.row-category div.share_alt a.pjax");
            foreach ($text as $key =>$value) {
                $I->comment("$value");
                if($value)  $I->comment("$key: $value");
            } 
        $ret=$I->CreateProduct($name, null, $price,null,null,$saleStatus,null,$articul,$amount,null,null,null,null,$shortDesc,$fullDesc,$comment='no',
                null,$oldPrice,null,$url,$mTitle,$mDesc,$mKeywords);
        $I->CheckInFields($name, null, $price, null, null, $saleStatus, $this->MainIso, $articul2, $amount, null, null, null, null,
                $shortDesc, $fullDesc, $comment='no', null, $oldPrice, null,$url,$mTitle,$mDesc,$mKeywords);
        $I->click(ProductsPage::$GoBackButton);
        $I->CheckInListLanding($name2.'...', null, $articul2, $price, $this->MAINSYM);
        $I->CheckInFrontEnd($name, null, $articul2, $price, $this->MAINSYM, null, null, null, null, $saleStatus, $shortDesc, $fullDesc, $comment='no', $oldPrice, $url);
    }
    
    /**
      * @guy ProductsTester\ProductsSteps
     */
    
    public function CreateProduct10_501Symbols(ProductsTester\ProductsSteps $I)
    {
        $name='В американском аэропорту Кеннеди журналист проводил опрос на тему : " Что по вашему мнению является самым отвратительным на свете? " Люди отвечали разное: война, бедность, предательство, болезни.. В это время в зале находился дзэнский монах Сунг Сан. Журналист, увидев буддийское одеяние, задал вопрос монаху. А монах задал встречный вопрос:- Кто вы? - Я, Джон Смит. - Нет, это имя, но кто Вы? - Я телерепортёр такой-то компании.. - Нет. Это профессия, но кто Вы? - Я человек, в конце концов!.. - Нет.';
        $name3='В американском аэропорту Кеннеди журналист проводил опрос на тему : " Что по вашему мнению является самым отвратительным на свете? " Люди отвечали разное: война, бедность, предательство, болезни.. В это время в зале находился дзэнский монах Сунг Сан. Журналист, увидев буддийское одеяние, задал вопрос монаху. А монах задал встречный вопрос:- Кто вы? - Я, Джон Смит. - Нет, это имя, но кто Вы? - Я телерепортёр такой-то компании.. - Нет. Это профессия, но кто Вы? - Я человек, в конце концов!.. - Нет';
        $price='3';//max=double(20,5)
        $saleStatus='';
        $articul='6478347894373894777493478 hfduyfguyguygygufduuuuuuuuuuuuuuuuuuuuudyyyf(00?==;hodfjkndghj56745+_Gfghfhfkdkjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjgggggggggggggg666666*8fgkjuhukgvuyxhcfvxx+gfgjfjfjffgggggggggg111113454545645645trrtgdrfdjh222jsjsjs5dfdfd555555555ddddd';//255
        $amount='123456';//max=11
        $shortDesc='В американском аэропорту Кеннеди журналист проводил опрос на тему : " Что по вашему мнению является самым отвратительным на свете? " Люди отвечали разное: война, бедность, предательство, болезни.. В это время в зале находился дзэнский монах Сунг Сан. Журналист, увидев буддийское одеяние, задал вопрос монаху. А монах задал встречный вопрос:- Кто вы? - Я, Джон Смит. - Нет, это имя, но кто Вы? - Я телерепортёр такой-то компании.. - Нет. Это профессия, но кто Вы? - Я человек, в конце концов!.. - Нет.';
        $fullDesc='В американском аэропорту Кеннеди журналист проводил опрос на тему : " Что по вашему мнению является самым отвратительным на свете? " Люди отвечали разное: война, бедность, предательство, болезни.. В это время в зале находился дзэнский монах Сунг Сан. Журналист, увидев буддийское одеяние, задал вопрос монаху. А монах задал встречный вопрос:- Кто вы? - Я, Джон Смит. - Нет, это имя, но кто Вы? - Я телерепортёр такой-то компании.. - Нет. Это профессия, но кто Вы? - Я человек, в конце концов!.. - Нет.';
        $oldPrice='4';//float(10,2)
//        $mainTemp=' dfd ';
//        $mainTemp2='dfd';
//        $mainTemp='sdjfosijffddg65656jrfjdj5454564jdfkdfdkfkfFGHFHgdgrty6567568654566666645645645645646464564564564564646456fghfhghfhhjghjghjghjgggsdjfosijffddg65656jrfjdj5454564jdfkdfdkfkfFGHFHgdgrty6567568654566666645645645645646464564564564564646456fghfhghfhhjghjghjghjgg';
        $mTitle='keyword credit ,';
        $mDesc='Choose words';
        $mKeywords='tags keyword attribute .';
        $I->amOnPage("/admin/components/run/shop/categories/index");
        $I->wait(3);
        $name2= substr($name, 0, 186);
        $I->clickAllElements($I,".btn.expandButton",3);        
        $text = $I->grabTextFromAllElements($I, "div.body_category div.row-category div.share_alt a.pjax");
            foreach ($text as $key =>$value) {
                $I->comment("$value");
                if($value)  $I->comment("$key: $value");
            } 
        $ret=$I->CreateProduct($name, null, $price,null,null,$saleStatus,null,$articul,$amount,null,null,null,null,$shortDesc,$fullDesc,$comment='no',
                null,$oldPrice,null,null,$mTitle,$mDesc,$mKeywords);
        $I->CheckInFields($name3, null, $price, null, null, $saleStatus, $this->MainIso, $articul, $amount, null, null, null, null,
                $shortDesc, $fullDesc, $comment='no', null, $oldPrice, null,null,$mTitle,$mDesc,$mKeywords);
        $I->click(ProductsPage::$GoBackButton);
        $I->CheckInListLanding($name2.'...', null, $articul, $price, $this->MAINSYM);
        $I->CheckInFrontEnd($name3, null, $articul, $price, $this->MAINSYM, null, null, null, null, $saleStatus, $shortDesc, $fullDesc, $comment='no', $oldPrice);
    }
    
    
    public function CreateProduct11_2StatusAndNotActive(ProductsTester\ProductsSteps $I)
    {
        $name='Телефон Panasonic';
        $price='77';//max=double(20,5)
        $saleStatus='';
        $hotStatus='';
        $I->amOnPage("/admin/components/run/shop/categories/index");
        $I->wait(3);
        $name2= substr($name, 0, 186);
        $I->clickAllElements($I,".btn.expandButton",3);        
        $text = $I->grabTextFromAllElements($I, "div.body_category div.row-category div.share_alt a.pjax");
            foreach ($text as $key =>$value) {
                $I->comment("$value");
                if($value)  $I->comment("$key: $value");
            } 
        $ret=$I->CreateProduct($name, null, $price,$hotStatus,null,$saleStatus,null,null,null,null,null,null,null,null,null,null,null,null,null,null,
                null,null,null,$active='no');
        $I->waitForText($name, '10', '//*[@id="mainContent"]/section/div/div[1]/span[2]');
        $I->wait('3');        
        $I->seeInField(\ProductsPage::$NameProduct, $name);
        $I->see($name, ".//*[@id='ProductVariantRow_0']/td[1]/div/div/span");
        $hotClass=$I->grabAttributeFrom(\ProductsPage::$HotProductButton, 'class');
        $I->assertEquals($hotClass, "btn btn-small  btn-primary active setHit");
        $newClass=$I->grabAttributeFrom(\ProductsPage::$NewProductButton, 'class');
        $I->assertEquals($newClass, "btn btn-small  setHot");
        $saleStatus=$I->grabAttributeFrom(\ProductsPage::$SaleProductButton, 'class');
        $I->assertEquals($saleStatus, "btn btn-small  btn-primary active setAction");
        $I->seeInField(\ProductsPage::$Price, $price);        
        $I->click(ProductsPage::$GoBackButton);
        $I->waitForText('Список товаров');
        $I->click(\ProductsPage::PaginationLine('last()'));
        $I->wait('2');
        $I->see($name, \ProductsPage::ProductNameLine('last()'));        
        $class=$I->grabAttributeFrom(\ProductsPage::ActiveButtonLine('last()'), 'class');
        $I->assertEquals($class, "prod-on_off disable_tovar");        
        $hotClass=$I->grabAttributeFrom(\ProductsPage::StatusLine1('last()'), 'class');
        $I->assertEquals($hotClass, "btn btn-small  btn-primary active setHit");        
        $newClass=$I->grabAttributeFrom(\ProductsPage::StatusLine2('last()'), 'class');
        $I->assertEquals($newClass, "btn btn-small  setHot");       
        $saleStatus=$I->grabAttributeFrom(\ProductsPage::StatusLine3('last()'), 'class');
        $I->assertEquals($saleStatus, "btn btn-small  btn-primary active setAction");        
        $I->seeInField(\ProductsPage::PriceFieldLine('last()'), $price);        
        $I->moveMouseOver(\ProductsPage::ProductNameLine('last()'));
        $I->wait('1');
        $I->click(\ProductsPage::ProductReviewButton('last()'));
        $I->executeInSelenium(function (\Webdriver $webdriver) {
            $handles=$webdriver->getWindowHandles();
            $last_window = end($handles);
            $webdriver->switchTo()->window($last_window);
        });        
    }
    
    
    public function CreateProduct12_2StatusAndActive(ProductsTester\ProductsSteps $I)
    {
        $name='Телефон Apple';
        $price='10000';//max=double(20,5)
        $newStatus='';
        $hotStatus='';
        $ret=$I->CreateProduct($name, null, $price,$hotStatus,$newStatus);
        $I->waitForText($name, '10', '//*[@id="mainContent"]/section/div/div[1]/span[2]');
        $I->wait('3');        
        $I->seeInField(\ProductsPage::$NameProduct, $name);
        $I->see($name, ".//*[@id='ProductVariantRow_0']/td[1]/div/div/span");
        $hotClass=$I->grabAttributeFrom(\ProductsPage::$HotProductButton, 'class');
        $I->assertEquals($hotClass, "btn btn-small  btn-primary active setHit");
        $newClass=$I->grabAttributeFrom(\ProductsPage::$NewProductButton, 'class');
        $I->assertEquals($newClass, "btn btn-small  btn-primary active setHot");
        $saleStatus=$I->grabAttributeFrom(\ProductsPage::$SaleProductButton, 'class');
        $I->assertEquals($saleStatus, "btn btn-small  setAction");
        $I->seeInField(\ProductsPage::$Price, $price);        
        $I->click(ProductsPage::$GoBackButton);
        $I->waitForText('Список товаров');
        $I->click(\ProductsPage::PaginationLine('last()'));
        $I->wait('2');
        $I->see($name, \ProductsPage::ProductNameLine('last()'));        
        $class=$I->grabAttributeFrom(\ProductsPage::ActiveButtonLine('last()'), 'class');
        $I->assertEquals($class, "prod-on_off");        
        $hotClass=$I->grabAttributeFrom(\ProductsPage::StatusLine1('last()'), 'class');
        $I->assertEquals($hotClass, "btn btn-small  btn-primary active setHit");        
        $newClass=$I->grabAttributeFrom(\ProductsPage::StatusLine2('last()'), 'class');
        $I->assertEquals($newClass, "btn btn-small  btn-primary active setHot");       
        $saleStatus=$I->grabAttributeFrom(\ProductsPage::StatusLine3('last()'), 'class');
        $I->assertEquals($saleStatus, "btn btn-small  setAction");        
        $I->seeInField(\ProductsPage::PriceFieldLine('last()'), $price);        
        $I->moveMouseOver(\ProductsPage::ProductNameLine('last()'));
        $I->wait('1');
        $I->click(\ProductsPage::ProductReviewButton('last()'));
        $I->executeInSelenium(function (\Webdriver $webdriver) {
            $handles=$webdriver->getWindowHandles();
            $last_window = end($handles);
        $webdriver->switchTo()->window($last_window);});
        $I->waitForElement(\CurrenciesPage::$SearchField);
        $I->see($name, "html/body/div[1]/div[2]/div[2]/div[1]/div/div[1]/div/h1");
        $I->see($price, \CurrenciesPage::$MainFirstPlaceCard);        
            $classHot=$I->grabAttributeFrom('//*[@id="photoProduct"]/span/span[2]', 'class');
            $I->assertEquals($classHot, "product-status hit");        
            $classHot=$I->grabAttributeFrom('//*[@id="photoProduct"]/span/span[3]', 'class');
            $I->assertEquals($classHot, "product-status nowelty");           
    }
    
    
    public function CreateProduct13_3StatusAndActive(ProductsTester\ProductsSteps $I)
    {
        $name='Телефон Samsung';
        $price='7890';//max=double(20,5)
        $newStatus='';
        $hotStatus='';
        $saleStatus='';
        $ret=$I->CreateProduct($name, null, $price,$hotStatus,$newStatus,$saleStatus);
        $I->waitForText($name, '10', '//*[@id="mainContent"]/section/div/div[1]/span[2]');
        $I->wait('3');        
        $I->seeInField(\ProductsPage::$NameProduct, $name);
        $I->see($name, ".//*[@id='ProductVariantRow_0']/td[1]/div/div/span");
        $hotClass=$I->grabAttributeFrom(\ProductsPage::$HotProductButton, 'class');
        $I->assertEquals($hotClass, "btn btn-small  btn-primary active setHit");
        $newClass=$I->grabAttributeFrom(\ProductsPage::$NewProductButton, 'class');
        $I->assertEquals($newClass, "btn btn-small  btn-primary active setHot");
        $saleStatus=$I->grabAttributeFrom(\ProductsPage::$SaleProductButton, 'class');
        $I->assertEquals($saleStatus, "btn btn-small  btn-primary active setAction");
        $I->seeInField(\ProductsPage::$Price, $price);        
        $I->click(ProductsPage::$GoBackButton);
        $I->waitForText('Список товаров');
        $I->click(\ProductsPage::PaginationLine('last()'));
        $I->wait('2');
        $I->see($name, \ProductsPage::ProductNameLine('last()'));        
        $class=$I->grabAttributeFrom(\ProductsPage::ActiveButtonLine('last()'), 'class');
        $I->assertEquals($class, "prod-on_off");        
        $hotClass=$I->grabAttributeFrom(\ProductsPage::StatusLine1('last()'), 'class');
        $I->assertEquals($hotClass, "btn btn-small  btn-primary active setHit");        
        $newClass=$I->grabAttributeFrom(\ProductsPage::StatusLine2('last()'), 'class');
        $I->assertEquals($newClass, "btn btn-small  btn-primary active setHot");       
        $saleStatus=$I->grabAttributeFrom(\ProductsPage::StatusLine3('last()'), 'class');
        $I->assertEquals($saleStatus, "btn btn-small  btn-primary active setAction");        
        $I->seeInField(\ProductsPage::PriceFieldLine('last()'), $price);        
        $I->moveMouseOver(\ProductsPage::ProductNameLine('last()'));
        $I->wait('1');
        $I->click(\ProductsPage::ProductReviewButton('last()'));
        $I->executeInSelenium(function (\Webdriver $webdriver) {
            $handles=$webdriver->getWindowHandles();
            $last_window = end($handles);
        $webdriver->switchTo()->window($last_window);});
        $I->waitForElement(\CurrenciesPage::$SearchField);
        $I->see($name, "html/body/div[1]/div[2]/div[2]/div[1]/div/div[1]/div/h1");
        $I->see($price, \CurrenciesPage::$MainFirstPlaceCard);        
            $classHot=$I->grabAttributeFrom('//*[@id="photoProduct"]/span/span[2]', 'class');
            $I->assertEquals($classHot, "product-status hit");        
            $classNew=$I->grabAttributeFrom('//*[@id="photoProduct"]/span/span[3]', 'class');
            $I->assertEquals($classNew, "product-status nowelty");
            $classSale=$I->grabAttributeFrom('//*[@id="photoProduct"]/span/span[4]', 'class');
            $I->assertEquals($classSale, "product-status action");
    }
}