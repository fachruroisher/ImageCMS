<?php

use \SeoExpertTester;
class ProductSEOCest

{
    private $ID_Russian_Name_Property;
    private $ID_Russian_Name_Product;
    private $ID_EngLish_Name_Property;
    private $ID_English_Name_Product;
    
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group a
     */
    public function Login(SeoExpertTester $I){
        InitTest::Login($I);
    } 
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function ClearCashee (SeoExpertTester\seoexpertSteps $I){
        InitTest::ClearAllCach($I);
        InitTest::changeTextAditorToNative($I);
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateCategoryRussianNameForProduct (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'Вода');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateCategoryEnglishNameForProduct (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'Water');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreatуBrandRusssianNameForProduct (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateBrand( $brandName = 'Хлеб',
                            $opisanie = '',
                            $title = '',
                            $description = '',
                            $keywords = '');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreatуBrandEnglishNameForProduct (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateBrand( $brandName = 'Bread',
                            $opisanie = '',
                            $title = '',
                            $description = '',
                            $keywords = '');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProductRussianNameForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateProduct(   $NameProduct            = 'Сеошний товар', 
                                $PriceProduct           = '777', 
                                $BrandProduct           = 'Хлеб', 
                                $CategoryProduct        = 'Вода',
                                $Additional_Category    = 'Water');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProductEnglishNameForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateProduct(   $NameProduct            = 'Seoshny product',
                                $PriceProduct           = '777', 
                                $BrandProduct           = 'Bread', 
                                $CategoryProduct        = 'Water',
                                $Additional_Category    = 'Вода');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreatePropertyRussianNameForProduct(SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateProperty(  $NameProperty   = 'Свойственно сео', 
                                $CVS            = 'XYXYxyxyxyxyXYXY', 
                                $Category       = 'Вода', 
                                $Values1        = 'Первое Свойство');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function SelectPropertyForRussianNameProduct(SeoExpertTester\seoexpertSteps $I) {
        $I->SeoSelectPropertyInProduct( $NameProduct    = 'Сеошний товар',
                                        $Property1      = 'Yes');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreatePropertyEnglishNameForProduct(SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateProperty(  $NameProperty   = 'Tend seo',
                                $CVS            = 'YYYYYyyyyyYYYYYY',
                                $Category       = 'Water', 
                                $Values1        = 'First property');
    }
    
    
     /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function SelectPropertyForEnglishNameProduct(SeoExpertTester\seoexpertSteps $I) {        
        $I->SeoSelectPropertyInProduct( $NameProduct    = 'Seoshny product',
                                        $Property1      = 'Yes');
    }
    

    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function GrabIDForCategoyProductInVariable (SeoExpertTester\seoexpertSteps $I) {   
        
        $ID_product_Rus = $I->GetProductID($name_product = 'Сеошний товар');
        $this->ID_Russian_Name_Product = $ID_product_Rus;        
        
        $ID_product_Eng = $I->GetProductID($name_product = 'Seoshny product');             
        $this->ID_English_Name_Product = $ID_product_Eng;
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function GrabIDForPropertyProductInVariable (SeoExpertTester\seoexpertSteps $I) {
        
        $ID_property_Eng = $I->GetPropertyID($name_property = 'Tend seo');  
        $this->ID_EngLish_Name_Property = $ID_property_Eng;
        
        $ID_property_Rus = $I->GetPropertyID($name_property = 'Свойственно сео');
        $this->ID_Russian_Name_Property = $ID_property_Rus;
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function DefoultValues (SeoExpertTester\seoexpertSteps $I) {
            $I->DefoultValues();  
    }
    

    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageTitleRus (SeoExpertTester\seoexpertSteps $I){          
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, "%ID% %name% %category% %brand% %price% %CS% %p_$this->ID_Russian_Name_Property%");
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLRu);
        $I->wait('1');
        $I->seeInPageSource("$this->ID_Russian_Name_Product Сеошний товар Вода Хлеб 777 руб Первое Свойство / mini.loc");            
    }
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageTitleEng (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, "%ID% %name% %category% %brand% %price% %CS% %p_$this->ID_EngLish_Name_Property%");
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLENG);
        $I->wait('1');
        $I->seeInPageSource("$this->ID_English_Name_Product Seoshny product Water Bread 777 руб First property / mini.loc");             
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageTitleTranslitRus (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, "%ID% %name[t]% %category[t]% %brand[t]% %price% %CS% %p_$this->ID_Russian_Name_Property%");
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLRu);
        $I->wait('1');
        $I->seeInPageSource("$this->ID_Russian_Name_Product Seoshnii tovar Voda Hleb 777 руб Первое Свойство / mini.loc");

    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageTitleTranslitEng (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, "%ID% %name[t]% %category[t]% %brand[t]% %price% %CS% %p_$this->ID_EngLish_Name_Property%");
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLENG);
        $I->wait('1');
        $I->seeInPageSource("$this->ID_English_Name_Product Seoshny product Water Bread 777 руб First property / mini.loc");             
    }
    
  
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageTitlePadeguName (SeoExpertTester\seoexpertSteps $I){   
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, "%name[1]% %name[2]% %name[3]% %name[4]% %name[5]% %name[6]%");
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLRu);
        $I->wait('1');
        $I->seeInPageSource('Сеошний товар Сеошнего товара Сеошнему товару Сеошнего товара Сеошним товаром Сеошнем товаре / mini.loc');
             
    }
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageTitlePadeguNameEng (SeoExpertTester\seoexpertSteps $I){    
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, "%name[1]% %name[2]% %name[3]% %name[4]% %name[5]% %name[6]%");
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLENG);
        $I->wait('1');
        $I->seeInPageSource("Seoshny product Seoshny product Seoshny product Seoshny product Seoshny product Seoshny product / mini.loc");             
    }

    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */

    public function ShopProductPageTitlePadeguCategory (SeoExpertTester\seoexpertSteps $I){  
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, "%category[1]% %category[2]% %category[3]% %category[4]% %category[5]% %category[6]%");
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLRu);
        $I->wait('1');
        $I->seeInPageSource('Вода Воды Воде Воду Водой Воде / mini.loc');             

    }
    
    
    

    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageTitlePadeguCategoryEng (SeoExpertTester\seoexpertSteps $I){     
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, "%category[1]% %category[2]% %category[3]% %category[4]% %category[5]% %category[6]%");
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLENG);
        $I->wait('1');
        $I->seeInPageSource("Water Water Water Water Water Water / mini.loc");             
    }
    
    

    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageDescriptionRus (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, '');
        $I->fillField(seoexpertPage::$SeoProductDescription, "%ID% %name% %category% %brand% %price% %CS% %p_$this->ID_Russian_Name_Property%");
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $I->fillField(seoexpertPage::$SeoProductLength, '');
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLRu);
        $I->wait('1');
        $I->seeInPageSource("$this->ID_Russian_Name_Product Сеошний товар Вода Хлеб 777 руб Первое Свойство / mini.loc");
       
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageDiscriprionEng (SeoExpertTester\seoexpertSteps $I){   
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, '');
        $I->fillField(seoexpertPage::$SeoProductDescription, "%ID% %name% %category% %brand% %price% %CS% %p_$this->ID_EngLish_Name_Property%");
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLENG);
        $I->wait('1');
        $I->seeInPageSource("$this->ID_English_Name_Product Seoshny product Water Bread 777 руб First property / mini.loc");             
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageDescriptionTranslitRus (SeoExpertTester\seoexpertSteps $I){
        $I->wait('1');               
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, '');
        $I->fillField(seoexpertPage::$SeoProductDescription, "%ID% %name[t]% %category[t]% %brand[t]% %price% %CS% %p_$this->ID_Russian_Name_Property%");
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $I->fillField(seoexpertPage::$SeoProductLength, '');
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLRu);
        $I->wait('1');
        $I->seeInPageSource("$this->ID_Russian_Name_Product Seoshnii tovar Voda Hleb 777 руб Первое Свойство / mini.loc");       
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageDiscriprionTranslitEng (SeoExpertTester\seoexpertSteps $I){  
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, '');
        $I->fillField(seoexpertPage::$SeoProductDescription, "%ID% %name[t]% %category[t]% %brand[t]% %price% %CS% %p_$this->ID_EngLish_Name_Property%");
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]';        
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLENG);
        $I->wait('1');
        $I->seeInPageSource("$this->ID_English_Name_Product Seoshny product Water Bread 777 руб First property / mini.loc");             

    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ICMS_1549___ShopProductPageDescriptionPadeguName (SeoExpertTester\seoexpertSteps $I){
        $I->DefoultValues();
        $I->wait('1');               
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, '');
        $I->fillField(seoexpertPage::$SeoProductDescription, "%name[1]% %name[2]% %name[3]% %name[4]% %name[5]% %name[6]%");
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $I->fillField(seoexpertPage::$SeoProductLength, '');
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLRu);
        $I->wait('1');
        $I->seeInPageSource("Сеошний товар Сеошнего товара Сеошнему товару Сеошнего товара Сеошним товаром Сеошнем товаре / mini.loc");       
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageDescriptionPadeguCategory (SeoExpertTester\seoexpertSteps $I){     
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, '');
        $I->fillField(seoexpertPage::$SeoProductDescription, "%category[1]% %category[2]% %category[3]% %category[4]% %category[5]% %category[6]%");
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $I->fillField(seoexpertPage::$SeoProductLength, '');
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLRu);
        $I->wait('1');
        $I->seeInPageSource("Вода Воды Воде Воду Водой Воде / mini.loc");       
    }
 
    
    
   
   
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageKeywordsRus (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, '');
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, "%name% %category% %brand% %p_$this->ID_Russian_Name_Property%");
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLRu);
        $I->wait('1');
        $I->seeInPageSource('Сеошний товар Вода Хлеб Первое Свойство');
             
    }
    
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageActive (SeoExpertTester\seoexpertSteps $I){ 
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, '%name%');
        $I->fillField(seoexpertPage::$SeoProductDescription, '%category%');
        $I->fillField(seoexpertPage::$SeoProductKeywords, "%brand%");
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]';
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLRu);
        $I->wait('1');
        $I->seeInPageSource('Сеошний товар / mini.loc');
        $I->seeInPageSource('Вода / mini.loc');
        $I->seeInPageSource('Хлеб');             
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageDeactive (SeoExpertTester\seoexpertSteps $I){ 
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->click(seoexpertPage::$SeoBaseSelectKeywords);
        $I->click(seoexpertPage::$SeoBaseOptionLeaveBlankKeywords);
        $I->click(seoexpertPage::$SeoBaseSelectDescription);
        $I->click(seoexpertPage::$SeoBaseOptionLeaveBlankDescription);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');   
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, '%name%');
        $I->fillField(seoexpertPage::$SeoProductDescription, 'Церберус офф %CS%');
        $I->fillField(seoexpertPage::$SeoProductKeywords, "Нига%price%Нига");
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLRu);
        $I->wait('1');
        $I->dontSeeInPageSource('Церберус офф руб');             
        $I->dontSeeInPageSource('Нига777Нига');             
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CheckBoxNullMetaData (SeoExpertTester\seoexpertSteps $I){
        $I->DefoultValues();
        $I->SeoProductFillFieldMettaData($name_product = 'Сеошний товар', $Meta_Title = 'ТАЙТЛ', $Meta_Description  = 'ОПИСАНИЕ', $Meta_Keywords = 'КЕЙВОРДС');
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, "%ID% %name% %category% %brand% %price% %CS% %p_$this->ID_Russian_Name_Property%");
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage(seoexpertPage::$FrontProductURLRu);
        $I->wait('1');
        $I->seeInPageSource('ТАЙТЛ');             
        $I->seeInPageSource('ОПИСАНИЕ');             
        $I->seeInPageSource('КЕЙВОРДС');   
        $I->dontSee("$this->ID_Russian_Name_Product");
    }
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function DeleteCategoryForJiraTests(SeoExpertTester\seoexpertSteps $I) {
        $I->DeleteProductCategorys();
    }
    
    
    
    
    
    
}