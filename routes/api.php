<?php

use Illuminate\Http\Request;
use App\Http\Resources\v1\Admin as AdminResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/author', function () {
    echo "Masoud Fathi";
});
Route::get('/save', 'CustomerController@customercreate');
Route::prefix('v1')->namespace('Api\v1')->group(function () {

    Route::get('/', function () {
        return "Welcome To Api";
    });
    Route::post('/login', 'AdminController@login');//اصلی
    Route::get('/login', 'AdminController@login');
    Route::post('/register', 'AdminController@register');//اصلی
    Route::get('/register', 'AdminController@register');
    Route::get('/logout', 'AdminController@logout')->middleware('auth:api');
    Route::post('/logout', 'AdminController@logout')->middleware('auth:api');
    Route::get('/lang/show', 'LangsController@lang');
    Route::get('/lang/{name}', 'LangsController@show');
    Route::post('/lang/{name}', 'LangsController@show');


    Route::post('/restpass1/email', 'AdminController@resetpassword1');//send email and resetpass
    Route::post('/restpass1/pass', 'AdminController@resetpassword2');//resetpass


    Route::post('/newpass/{id}/{pass}', 'AdminController@newpass');
    Route::get('/newpass/{id}/{pass}', 'AdminController@newpass');
    Route::post('/newpass/{id}/{pass}/{fa}', 'AdminController@newpass1');
    Route::get('/newpass/{id}/{pass}/{fa}', 'AdminController@newpass1');

//    Route::middleware('auth:api')->group(function () {
    Route::middleware('auth:api')->group(function () {

        Route::get('/user', function () {

            return new AdminResource(auth()->user());
        });
        Route::get('/api_token', 'AdminController@api_token');
        Route::get('/id', 'AdminController@id');
        Route::get('/admin', 'AdminController@index');
        Route::get('/admin/{admin}', 'AdminController@single');
        Route::post('/admin', 'AdminController@store');
        Route::get('/admin', 'AdminController@store');
        Route::post('admin1/{id}', 'AdminController@update');
        Route::get('admin1/{id}', 'AdminController@update');
        Route::post('admin1/{id}/{fa}', 'AdminController@update1');
        Route::get('admin1/{id}/{fa}', 'AdminController@update1');
        Route::get('admindel/{id}', 'AdminController@delete');
        Route::get('admindel/{id}/{fa}', 'AdminController@delete1');
        //-------------
        Route::post('/attribute', 'AttributesController@att');
        Route::get('/attribute', 'AttributesController@att');
        Route::post('/attribute/{fa}', 'AttributesController@att1');
        Route::get('/attribute/{fa}', 'AttributesController@att1');
        Route::post('/attributeedit/{id}', 'AttributesController@edit');
        Route::get('/attributeedit/{id}', 'AttributesController@edit');
        Route::post('/attributeedit/{id}/{fa}', 'AttributesController@edit1');
        Route::get('/attributeedit/{id}/{fa}', 'AttributesController@edit1');
        Route::post('/attributedel/{id}', 'AttributesController@delete');
        Route::get('/attributedel/{id}', 'AttributesController@delete');
        Route::post('/attributedel/{id}/{fa}', 'AttributesController@delete1');
        Route::get('/attributedel/{id}/{fa}', 'AttributesController@delete1');
        //--------------
        Route::post('/comment', 'CommentController@store');
        Route::get('/comment', 'CommentController@store');
        Route::post('/comment/{fa}', 'CommentController@store1');
        Route::get('/comment/{fa}', 'CommentController@store1');
        Route::post('/commentanswer', 'CommentController@answer');
        Route::get('/commentanswer', 'CommentController@answer');
        Route::post('/commentanswer/{fa}', 'CommentController@answer1');
        Route::get('/commentanswer/{fa}', 'CommentController@answer1');
        //--------------
        Route::post('/email/email={f}', 'EmailsController@email');
        Route::get('/email/email={f}', 'EmailsController@email');
        Route::post('/email/email={f}/{fa}', 'EmailsController@email1');
        Route::get('/email/email={f}/{fa}', 'EmailsController@email1');
        Route::post('/email11/email={f}', 'EmailsController@email11');
        Route::get('/email11/email={f}', 'EmailsController@email11');
        Route::get('/email/show', 'EmailsController@show');
        Route::get('/email/delete/{id}', 'EmailsController@det');
        Route::get('/email/delete/{id}/{fa}', 'EmailsController@det1');
        //--------------
        Route::post('/folder/c/{id}', 'FolderController@c');
        Route::post('/folder', 'FolderController@f');
        Route::get('/folder', 'FolderController@f');
        Route::post('/folder/{api}/name={name}', 'FolderController@newfolder');//ایجاد فولدر به وسیله get
        Route::get('/folder/{api}/name={name}', 'FolderController@newfolder');
        Route::post('/folder/{api}/name={name}/{fa}', 'FolderController@newfolder1');
        Route::get('/folder/{api}/name={name}/{fa}', 'FolderController@newfolder1');
        Route::post('/folder/{fa}', 'FolderController@f1');
        Route::get('/folder/{fa}', 'FolderController@f1');
        Route::get('/folder/show/{id?}', 'FolderController@show');
        Route::post('/folder/delete/{id}', 'FolderController@det');
        Route::get('/folder/delete/{id}', 'FolderController@det');
        Route::post('/folder/delete/{id}/{fa}', 'FolderController@det1');
        Route::get('/folder/delete/{id}/{fa}', 'FolderController@det1');
        //--------------
        Route::post('/form', 'FormController@form1');
        Route::post('/form/disable/{id}','FormController@disable');
        Route::post('/form/disable_date/{id}/{date}', 'FormController@disable_to_date');
        Route::post('/form/enable/{id}','FormController@enable');
        Route::post('/form/fav_enable/{id}','FormController@fav_enable');
        Route::post('/form/fav_disable/{id}','FormController@fav_disable');
        Route::post('/form/submission/{id}','FormController@submission');
        Route::post('/form/rename/{id}', 'FormController@rename');
        Route::post('/form/rename/{id}/{fa}', 'FormController@rename_fa');
        Route::post('/form/history/{form_id}', 'FormController@show_history');

        //sort
        Route::get('/form/sort','FormController@sort');
        Route::get('/form/sort1','FormController@sort1');
        Route::get('/form/sort2','FormController@sort2');
        Route::get('/form/sort3','FormController@sort3');
        Route::get('/form/mpdf','FormController@dh');
        //end sort
        Route::post('/form/search/{keyword}','FormController@search');
        Route::get('/form', 'FormController@form1');
        Route::post('/formshow1', 'FormController@showall');
        Route::post('/formshow', 'FormController@show');
        Route::get('/formshow', 'FormController@show');
        Route::post('/formshowname', 'FormController@showname');
        Route::get('/formshowname', 'FormController@showname');
        Route::post('/form/{api}/name={name}', 'FormController@newform1');
        Route::get('/form/{api}/name={name}', 'FormController@newform1');
        Route::post('/form/{fa}', 'FormController@form11');
        Route::get('/form/{fa}', 'FormController@form11');
        Route::post('/form/delete/{id}', 'FormController@det');
        Route::get('/form/delete/{id}', 'FormController@det');
        Route::post('/form/delete/{id}/{fa}', 'FormController@det1');
        Route::get('/form/delete/{id}/{fa}', 'FormController@det1');
        //--------------
        Route::post('/form_responders/{id}', 'Form_respondersController@create');
        Route::get('/form_responders/{id}', 'Form_respondersController@create');
        Route::post('/form_responders/{id}/{fa}', 'Form_respondersController@create1');
        Route::get('/form_responders/{id}/{fa}', 'Form_respondersController@create1');

        Route::post('/form_responder/update/{id}', 'Form_respondersController@update');
        Route::get('/form_responder/update/{id}', 'Form_respondersController@update');
        Route::post('/form_responder/update/{id}/{fa}', 'Form_respondersController@update1');
        Route::get('/form_responder/update/{id}/{fa}', 'Form_respondersController@update1');
        Route::get('/form_respondersshow', 'Form_respondersController@show');
        Route::get('/form_responders/delete/{id}', 'Form_respondersController@det');
        Route::get('/form_responders/delete/{id}/{fa}', 'Form_respondersController@det1');
        //--------------
        Route::post('/form_permission/{id}', 'Form_PermissionController@form_permission1');
        Route::get('/form_permission/{id}', 'Form_PermissionController@form_permission1');
        Route::post('/form_permission/{id}/{fa}', 'Form_PermissionController@form_permission11');
        Route::get('/form_permission/{id}/{fa}', 'Form_PermissionController@form_permission11');
        Route::get('/form_permissionn', 'Form_PermissionController@show');
        Route::post('/form_permissionn/{id}', 'Form_PermissionController@update');
        Route::get('/form_permissionn/{id}', 'Form_PermissionController@update');
        Route::post('/form_permissionn/{id}/{fa}', 'Form_PermissionController@update1');
        Route::get('/form_permissionn/{id}/{fa}', 'Form_PermissionController@update1');
        //--------------
        Route::post('form_star/{id}', 'Form_StarController@form_star');
        Route::get('form_star/{id}', 'Form_StarController@form_star');
        Route::post('form_star/{id}/{fa}', 'Form_StarController@form_star1');
        Route::get('form_star/{id}/{fa}', 'Form_StarController@form_star1');
        Route::post('form_stars/{id}', 'Form_StarController@favorite1');
        Route::get('form_stars/{id}', 'Form_StarController@favorite1');
        Route::post('form_stars/{id}/{fa}', 'Form_StarController@favorite11');
        Route::get('form_stars/{id}/{fa}', 'Form_StarController@favorite11');
        Route::get('form_star/show', 'Form_StarController@show');
        Route::post('form_star1/delete/{id}', 'Form_StarController@det');
        Route::get('form_star1/delete/{id}', 'Form_StarController@det');
        Route::post('form_star1/delete/{id}/{fa}', 'Form_StarController@det1');
        Route::get('form_star1/delete/{id}/{fa}', 'Form_StarController@det1');
        //--------------
        Route::post('/form_tools/{form_id}', 'Form_ToolsController@form_tools');
        Route::get('/form_tools/{form_id}', 'Form_ToolsController@form_tools');
        Route::post('/form_tools/{form_id}/{fa}', 'Form_ToolsController@form_tools1');
        Route::get('/form_tools/{form_id}/{fa}', 'Form_ToolsController@form_tools1');
        Route::get('/form_tool/show', 'Form_ToolsController@showall');
        Route::post('/form_toolss/show/{id}', 'Form_ToolsController@show');
        Route::get('/form_toolss/show/{id}', 'Form_ToolsController@show');
        Route::post('/form_tools/showw/{id}/{name}', 'Form_ToolsController@showformtools');
        Route::get('/form_tools/showw/{id}/{name}', 'Form_ToolsController@showformtools');
        Route::post('/form_tools/cat_id/{id}/{fa}', 'Form_ToolsController@cat_id1');
        Route::get('/form_tools/cat_id/{id}/{fa}', 'Form_ToolsController@cat_id1');
        Route::get('/form_tools/delete/{id}', 'Form_ToolsController@det');
        Route::get('/form_tools/delete/{id}/{fa}', 'Form_ToolsController@det1');

        //--------------
        Route::post('/form_tool_attribute/{id}', 'Form_Tool_AttributeController@form_tool_attribute');
        Route::get('/form_tool_attribute/{id}', 'Form_Tool_AttributeController@form_tool_attribute');
        Route::post('/form_tool_attribute/{id}/{fa}', 'Form_Tool_AttributeController@form_tool_attribute1');
        Route::get('/form_tool_attribute/{id}/{fa}', 'Form_Tool_AttributeController@form_tool_attribute1');
        Route::get('/form_tool_attribute/show', 'Form_Tool_AttributeController@show');
        Route::get('/form_tool_attribute/delete/{id}', 'Form_Tool_AttributeController@det');
        Route::get('/form_tool_attribute/delete/{id}/{fa}', 'Form_Tool_AttributeController@det1');
        //--------------
        Route::get('/sms/{name}/{sender?}', 'SmsController@sms');
        Route::get('/sms/{name}/{sender}/{fa}', 'SmsController@sms1');
        Route::get('/sms/{name}/{sender?}', 'SmsController@sms');
        Route::get('/sms/{name}/{sender}/{fa}', 'SmsController@sms1');
        Route::post('/sms/edit/{id}/{name}/{sender}', 'SmsController@edit');
        Route::get('/sms/edit/{id}/{name}/{sender}', 'SmsController@edit');
        Route::post('/smss/delete/{id}', 'SmsController@delete');
        Route::get('/smss/delete/{id}', 'SmsController@delete');
        Route::post('/smss/delete/{id}/{fa}', 'SmsController@delete1');
        Route::get('/smss/delete/{id}/{fa}', 'SmsController@delete1');
        Route::get('/smsshow', 'SmsController@show');
        Route::post('/smssend/{mobile}/{message}', 'SmsController@send');
        Route::get('/smssend/{mobile}/{message}', 'SmsController@send');

        //--------------
        Route::post('/submission/{id}', 'SubmissionController@submission');
        Route::get('/submission/{id}', 'SubmissionController@submission');
        Route::post('/submission/{id}/{fa}', 'SubmissionController@submission1');
        Route::get('/submission/{id}/{fa}', 'SubmissionController@submission1');
        Route::get('/submission/show', 'SubmissionController@show');
        Route::get('/submission/delete/{id}', 'SubmissionController@det');
        Route::get('/submission/delete/{id}/{fa}', 'SubmissionController@det1');
        Route::get('/peyment', 'SubmissionController@peyment');
        //--------------
        Route::post('/submission_answer/{submission_id}/{answer}', 'Submission_AnswersController@submission_answer');
        Route::get('/submission_answer/{submission_id}/{answer}', 'Submission_AnswersController@submission_answer');
        Route::post('/submission_answer/{submission_id}/{answer}/{fa}', 'Submission_AnswersController@submission_answer1');
        Route::get('/submission_answer/{submission_id}/{answer}/{fa}', 'Submission_AnswersController@submission_answer1');
        Route::get('/submission_answerr/delete/{id}', 'Submission_AnswersController@delete');
        Route::get('/submission_answerr/delete/{id}/{fa}', 'Submission_AnswersController@delete1');
        //--------------
        Route::post('/templates/{name}', 'TemplatesController@templates');
        Route::get('/templates/{name}', 'TemplatesController@templates');
        Route::post('/templates/{name}/{fa}', 'TemplatesController@templates1');
        Route::get('/templates/{name}/{fa}', 'TemplatesController@templates1');
        Route::get('/templates/show', 'TemplatesController@show');
        Route::post('/templates/{fa}', 'TemplatesController@templates1');
        Route::get('/templates/{fa}', 'TemplatesController@templates1');
        Route::post('/templatesd/{id}', 'TemplatesController@delete');
        Route::get('/templatesd/{id}', 'TemplatesController@delete');
        Route::post('/templatesd/{id}/{fa}', 'TemplatesController@delete1');
        Route::get('/templatesd/{id}/{fa}', 'TemplatesController@delete1');
        //--------------
        Route::post('/tools', 'ToolsController@tools');
        Route::get('/tools', 'ToolsController@tools');
        Route::post('/tools/{fa}', 'ToolsController@tools1');
        Route::get('/tools/{fa}', 'ToolsController@tools1');
        Route::get('/toolsdel/{id}', 'ToolsController@delete');
        Route::get('/toolsdel/{id}/{fa}', 'ToolsController@delete1');
        Route::get('/tools12/show', 'ToolsController@show');
        Route::get('/tools12/showall', 'ToolsController@show_all');
        Route::get('/tools12/showname/{name}', 'ToolsController@show_name');
        Route::get('/tools12/showid/{id}', 'ToolsController@show_id1');
        Route::post('/tool/{id}', 'ToolsController@show_id');
        Route::get('/tool/{id}', 'ToolsController@show_id');
        //--------------
        Route::post('/tools_attributes/{default_value_en}/{default_value_fa}/{attribute_id}', 'Tools_AttributesController@tools_attributes');
        Route::get('/tools_attributes/{default_value_en}/{default_value_fa}/{attribute_id}', 'Tools_AttributesController@tools_attributes');
        Route::post('/tools_attributes/{default_value_en}/{default_value_fa}/{attribute_id}/{fa}', 'Tools_AttributesController@tools_attributes1');
        Route::get('/tools_attributes/{default_value_en}/{default_value_fa}/{attribute_id}/{fa}', 'Tools_AttributesController@tools_attributes1');
        Route::post('/tools_attributesdel/{id}', 'Tools_AttributesController@delete');
        Route::get('/tools_attributesdel/{id}', 'Tools_AttributesController@delete');
        Route::post('/tools_attributesdel/{id}/{fa}', 'Tools_AttributesController@delete1');
        Route::get('/tools_attributesdel/{id}/{fa}', 'Tools_AttributesController@delete1');
        Route::post('/tools_attributesupdate/{id}/{default_value_en}/{default_value_fa}', 'Tools_AttributesController@update');
        Route::get('/tools_attributesupdate/{id}/{default_value_en}/{default_value_fa}', 'Tools_AttributesController@update');
        Route::post('/tools_attributesupdate/{id}/{default_value_en}/{default_value_fa}/{fa}', 'Tools_AttributesController@update1');
        Route::get('/tools_attributesupdate/{id}/{default_value_en}/{default_value_fa}/{fa}', 'Tools_AttributesController@update1');
        Route::post('/tools_attributestool/{id}', 'Tools_AttributesController@tool_id');
        Route::get('/tools_attributestool/{id}', 'Tools_AttributesController@tool_id');
        Route::get('/tools_attributes/show', 'Tools_AttributesController@show1');
        //--------------
        Route::post('/tools_categories/{name_en}/{name_fa}', 'Tools_CategoriesController@tools_categories');
        Route::get('/tools_categories/{name_en}/{name_fa}', 'Tools_CategoriesController@tools_categories');
        Route::post('/tools_categories/{name_en}/{name_fa}/{fa}', 'Tools_CategoriesController@tools_categories1');
        Route::get('/tools_categories/{name_en}/{name_fa}/{fa}', 'Tools_CategoriesController@tools_categories1');
        Route::post('/tools_categoriesdel/{id}', 'Tools_CategoriesController@delete');
        Route::get('/tools_categoriesdel/{id}', 'Tools_CategoriesController@delete');
        Route::post('/tools_categoriesdel/{id}/{fa}', 'Tools_CategoriesController@delete1');
        Route::get('/tools_categoriesdel/{id}/{fa}', 'Tools_CategoriesController@delete1');
        Route::post('/tools_categorieshow/{id}/{name}', 'Tools_CategoriesController@show');
        Route::get('/tools_categorieshow/{id}/{name}', 'Tools_CategoriesController@show');
        Route::get('/tools_categoriesshoww/en', 'Tools_CategoriesController@show1');
        Route::get('/tools_categoriesshoww/fa', 'Tools_CategoriesController@show12');
        //--------------
        Route::post('/value/{value}/{submission_id}/{form_tool_id}', 'ValueController@value');
        Route::get('/value/{value}/{submission_id}/{form_tool_id}', 'ValueController@value');
        Route::post('/value/{value}/{submission_id}/{form_tool_id}/{fa}', 'ValueController@value1');
        Route::get('/value/{value}/{submission_id}/{form_tool_id}/{fa}', 'ValueController@value1');
        Route::post('/valuedel/{id}', 'ValueController@delete');
        Route::get('/valuedel/{id}', 'ValueController@delete');
        Route::post('/valuedel/{id}/{fa}', 'ValueController@delete1');
        Route::get('/valuedel/{id}/{fa}', 'ValueController@delete1');
        Route::post('/valueedit/{id}/{value}/{submission_id}/{form_tool_id}', 'ValueController@edit');
        Route::get('/valueedit/{id}/{value}/{submission_id}/{form_tool_id}', 'ValueController@edit');
        Route::post('/valueedit/{id}/{value}/{submission_id}/{form_tool_id}/{fa}', 'ValueController@edit1');
        Route::get('/valueedit/{id}/{value}/{submission_id}/{form_tool_id}/{fa}', 'ValueController@edit1');
        Route::get('/value/show', 'ValueController@show');
        //---------------------------------------------------------------------------------------------
        //---------------------------------------------------------------------------------------------
        //-----------------------general,option,advance public api---------------------------------------------------------------------
        Route::get('/general_api/show/{name}', 'GeneralController@show1');//این بین همه general apiمشترک هست
        Route::get('/general_api/showall', 'GeneralController@showall');
        Route::get('/option/show/{id}/{name}', 'OptionController@option_show');
        Route::get('/option/showall', 'OptionController@option_t_showall');
        Route::get('/type_name/{form_id}', 'GeneralController@type_name');
        //-----------------------start heading------------------------------------------------------------------------
        Route::post('/heading1/create', 'HeadingController@heading_create1');
        Route::get('/heading1/show/{id}', 'HeadingController@heading_show1');
        Route::get('/heading1/show2/{form_id}', 'HeadingController@heading_show2');
        Route::get('/heading1/delete/{id}', 'HeadingController@heading_delete1');
        Route::post('/heading1/edit/{id}', 'HeadingController@heading_edit1');
        Route::post('/heading1/image', 'HeadingController@heading_image');
        Route::post('/heading1/image/edit/{id}', 'HeadingController@heading_image_edit');
        Route::post('/heading1/image/delete/{id}', 'HeadingController@heading_image_delete');
        Route::get('/heading1/image/show/{id}', 'HeadingController@heading_image_show1');
        Route::get('/heading1/image/show2/{form_id}', 'HeadingController@heading_image_show2');

        Route::get('/heading/show_en', 'GeneralController@heading_show_en');
        Route::get('/heading/show_fa/{fa}', 'GeneralController@heading_show_fa');
        Route::post('/heading/create', 'GeneralController@heading_create');
        Route::get('/heading/create', 'GeneralController@heading_create');
        Route::post('/heading/create/{fa}', 'GeneralController@heading_create_fa');
        Route::get('/heading/create/{fa}', 'GeneralController@heading_create_fa');
        Route::post('/heading/show/{id}/{name}', 'GeneralController@heading_show');
        Route::get('/heading/show/{id}/{name}', 'GeneralController@heading_show');
        Route::post('/heading/edit/{id}', 'GeneralController@heading_edit');
        Route::get('/heading/edit/{id}', 'GeneralController@heading_edit');
        Route::post('/heading/edit/{id}/{fa}', 'GeneralController@heading_edit_fa');
        Route::get('/heading/edit/{id}/{fa}', 'GeneralController@heading_edit_fa');
        Route::get('/heading/delete/{id}', 'GeneralController@heading_delete');
        Route::get('/heading/delete/{id}/{fa}', 'GeneralController@heading_delete_fa');
        //-----------------------End heading------------------------------------------------------------------------
        //-----------------------start fullname------------------------------------------------------------------------
        Route::get('/fullname/show_en', 'GeneralController@fullnameshow_en');
        Route::get('/fullname/show_fa/{fa}', 'GeneralController@fullnameshow_fa');
        Route::post('/fullname/create', 'GeneralController@create');
        Route::get('/fullname/create', 'GeneralController@create');
        Route::post('/fullname/create/{fa}', 'GeneralController@create1');
        Route::get('/fullname/create/{fa}', 'GeneralController@create1');
        Route::post('/fullname/show/{id}/{name}', 'GeneralController@show');
        Route::get('/fullname/show/{id}/{name}', 'GeneralController@show');
        Route::post('/fullname/edit/{id}', 'GeneralController@edit');
        Route::get('/fullname/edit/{id}', 'GeneralController@edit');
        Route::post('/fullname/edit/{id}/{fa}', 'GeneralController@edit1');
        Route::get('/fullname/edit/{id}/{fa}', 'GeneralController@edit1');
        Route::get('/fullname/delete/{id}', 'GeneralController@delete');
        Route::get('/fullname/delete/{id}/{fa}', 'GeneralController@delete1');
        //---------------------------start option fullname-------------------------------------------------
        Route::get('/option/fullname/show_en', 'OptionController@option_fullname_show_en');
        Route::get('/option/fullname/show_fa/{fa}', 'OptionController@option_fullname_show_fa');
        //-------------------------------end option fullname---------------------------------------------
        //---------------------------start advance fullname-------------------------------------------------
        Route::get('/advance/fullname/show_en', 'AdvancedController@advance_fullname_show_en');
        Route::get('/advance/fullname/show_fa/{fa}', 'AdvancedController@advance_fullname_show_fa');
        Route::post('/advance/fullname/create', 'AdvancedController@advance_fullname_create');
        Route::get('/advance/fullname/create/{placeholder}/{readonly}/{hidefield}/{form_id}', 'AdvancedController@advance_fullname_create_get');
        Route::post('/advance/fullname/create/{fa}', 'AdvancedController@advance_fullname_create_fa');
        Route::get('/advance/fullname/create/{placeholder}/{readonly}/{hidefield}/{form_id}/{fa}', 'AdvancedController@advance_fullname_create_get_fa');
        Route::get('/advance/fullname/show/{id}', 'AdvancedController@advance_fullname_show');
        Route::get('/advance/fullname/showall/{form_id}', 'AdvancedController@advance_fullname_showall');
        Route::post('/advance/fullname/edit/{id}', 'AdvancedController@advance_fullname_edit');
        Route::get('/advance/fullname/edit/{id}/{placeholder}/{readonly}/{hidefield}', 'AdvancedController@advance_fullname_edit_get');
        Route::get('/advance/fullname/edit/{id}/{placeholder}/{readonly}/{hidefield}/{fa}', 'AdvancedController@advance_fullname_edit_get_fa');
        Route::post('/advance/fullname/edit/{id}/{fa}', 'AdvancedController@advance_fullname_edit_fa');
        Route::get('/advance/fullname/delete/{id}', 'AdvancedController@advance_fullname_delete');
        Route::get('/advance/fullname/delete/{id}/{fa}', 'AdvancedController@advance_fullname_delete_fa');

        //-------------------------------End advance fullname---------------------------------------------
        //---------------------------------End fullname-------------------------------------------------------
        //-------------------------- ------start email------------------------------------------------------------
        Route::get('/email/show_en', 'GeneralController@emailshow_en');
        Route::get('/email/show_fa/{fa}', 'GeneralController@emailshow_fa');
        Route::post('/email/create', 'GeneralController@email_create');
        Route::get('/email/create', 'GeneralController@email_create');
        Route::post('/email/create/{fa}', 'GeneralController@email_create_fa');
        Route::get('/email/create/{fa}', 'GeneralController@email_create_fa');
        Route::post('/email/edit/{id}', 'GeneralController@email_edit');
        Route::post('/email/edit/{id}', 'GeneralController@email_edit');
        Route::post('/email/edit/{id}/{fa}', 'GeneralController@email_edit_fa');
        Route::get('/email/edit/{id}/{fa}', 'GeneralController@email_edit_fa');
        Route::get('/email/delete/{id}', 'GeneralController@email_delete');
        Route::get('/email/delete/{id}/{fa}', 'GeneralController@email_delete_fa');
        Route::get('/email/show/{id}/{name}', 'GeneralController@email_show');
        //---------------------------start option email-------------------------------------------------
        Route::get('/option/email/show_en', 'OptionController@option_email_show_en');
        Route::get('/option/email/show_fa/{fa}', 'OptionController@option_email_show_fa');
        //---------------------------end option email---------------------------------------------
        //---------------------------start advance email---------------------------------------------
        Route::get('/advance/email/show_en', 'AdvancedController@advance_email_show_en');
        Route::get('/advance/email/show_fa/{fa}', 'AdvancedController@advance_email_show_fa');
        Route::post('/advance/email/create', 'AdvancedController@advance_email_create');
        Route::get('/advance/email/create/{placeholder_email}/{default_value}/{read_only}/{hide_field}/{form_id}', 'AdvancedController@advance_email_create_get');
        Route::post('/advance/email/create/{fa}', 'AdvancedController@advance_email_create_fa');
        Route::get('/advance/email/create/{placeholder_email}/{default_value}/{read_only}/{hide_field}/{form_id}/{fa}', 'AdvancedController@advance_email_create_get_fa');
        Route::get('/advance/email/show/{id}', 'AdvancedController@advance_email_show');
        Route::get('/advance/email/showall/{form_id}', 'AdvancedController@advance_email_showall');
        Route::post('/advance/email/edit/{id}', 'AdvancedController@advance_email_edit');
        Route::get('/advance/email/edit/{id}/{placeholder_email}/{default_value}/{read_only}/{hide_field}', 'AdvancedController@advance_email_edit_get');
        Route::post('/advance/email/edit/{id}/{placeholder}/{readonly}/{hidefield}/{fa}', 'AdvancedController@advance_email_edit_get_fa');
        Route::get('/advance/email/edit/{id}/{fa}', 'AdvancedController@advance_email_edit_fa');
        Route::get('/advance/email/delete/{id}', 'AdvancedController@advance_email_delete');
        Route::get('/advance/email/delete/{id}/{fa}', 'AdvancedController@advance_email_delete_fa');
        //---------------------------------End advance email---------------------------------------------
       //---------------------------------start confirmation email-----------------------
        Route::get('/advance/confirmation/email/show_en', 'AdvancedController@confirmation_email_show_en');
        Route::get('/advance/confirmation/email/show_fa/{fa}', 'AdvancedController@aconfirmation_email_show_fa');
        Route::post('/advance/confirmation/email/create', 'AdvancedController@confirmation_email_create');
        Route::get('/advance/confirmation/email/create/{confirmation_text_box}/{form_id}', 'AdvancedController@confirmation_email_create_get');
        Route::post('/advance/confirmation/email/create/{fa}', 'AdvancedController@confirmation_email_create_fa');
        Route::get('/advance/confirmation/email/create/{confirmation_text_box}/{form_id}/{fa}', 'AdvancedController@confirmation_email_create_get_fa');
        Route::get('/advance/confirmation/email/show/{id}', 'AdvancedController@confirmation_email_show');
        Route::get('/advance/confirmation/email/showall/{form_id}', 'AdvancedController@confirmation_email_showall');
        Route::post('/advance/confirmation/email/edit/{id}', 'AdvancedController@confirmation_email_edit');
        Route::get('/advance/confirmation/email/edit/{id}/{confirmation_text_box}', 'AdvancedController@confirmation_email_edit_get');
        Route::post('/advance/confirmation/email/edit/{id}/{confirmation_text_box}/{fa}', 'AdvancedController@confirmation_email_edit_get_fa');
        Route::get('/advance/confirmation/email/edit/{id}/{fa}', 'AdvancedController@confirmation_email_edit_fa');
        Route::get('/advance/confirmation/email/delete/{id}', 'AdvancedController@confirmation_email_delete');
        Route::get('/advance/confirmation/email/delete/{id}/{fa}', 'AdvancedController@confirmation_email_delete_fa');
        //--------------------------------end confirmation email-------------------------
        //----------------------------------End email--------------------------------------------------------
        //----------------------------------start address----------------------------------------------------
        Route::get('/address/show_en', 'GeneralController@address_show_en');
        Route::get('/address/show_fa/{fa}', 'GeneralController@address_show_fa');
        Route::post('/address/create', 'GeneralController@address_create');
        Route::get('/address/create', 'GeneralController@address_create');
        Route::post('/address/create/{fa}', 'GeneralController@address_create_fa');
        Route::get('/address/create/{fa}', 'GeneralController@address_create_fa');
        Route::post('/address/edit/{id}', 'GeneralController@address_edit');
        Route::get('/address/edit/{id}', 'GeneralController@address_edit');
        Route::post('/address/edit/{id}/{fa}', 'GeneralController@address_edit_fa');
        Route::get('/address/edit/{id}/{fa}', 'GeneralController@address_edit_fa');
        Route::get('/address/delete/{id}', 'GeneralController@address_delete');
        Route::get('/address/delete/{id}/{fa}', 'GeneralController@address_delete_fa');
        Route::get('/address/show/{id}/{name}', 'GeneralController@address_show');
        //----------------------------start option address---------------------------------------
        Route::get('/option/address/show_en', 'OptionController@option_address_show_en');
        Route::get('/option/address/show_fa/{fa}', 'OptionController@option_address_show_fa');
        //----------------------------End option address-----------------------------------------
        //----------------------------start advance address-----------------------------------------
        Route::get('/advance/address/show_en', 'AdvancedController@advance_address_show_en');
        Route::get('/advance/address/show_fa/{fa}', 'AdvancedController@advance_address_show_fa');
        Route::post('/advance/address/create', 'AdvancedController@advance_address_create');
        Route::get('/advance/address/create/{street_address1}/{street_address2}/{city}/{state}/{zip_code}/{location}/{hide_field_address}/{form_id}', 'AdvancedController@advance_address_create_get');
        Route::post('/advance/address/create/{fa}', 'AdvancedController@advance_address_create_fa');
        Route::get('/advance/address/create/{street_address1}/{street_address2}/{city}/{state}/{zip_code}/{location}/{hide_field_address}/{form_id}/{fa}', 'AdvancedController@advance_address_create_get_fa');
        Route::get('/advance/address/show/{id}', 'AdvancedController@advance_address_show');
        Route::get('/advance/address/showall/{form_id}', 'AdvancedController@advance_address_showall');
        Route::post('/advance/address/edit/{id}', 'AdvancedController@advance_address_edit');
        Route::get('/advance/address/edit/{id}/{street_address1}/{street_address2}/{city}/{state}/{zip_code}/{location}/{hide_field_address}', 'AdvancedController@advance_address_edit_get');
        Route::post('/advance/address/edit/{id}/{fa}', 'AdvancedController@advance_address_edit_fa');
        Route::get('/advance/address/edit/{id}/{street_address1}/{street_address2}/{city}/{state}/{zip_code}/{location}/{hide_field_address}/{fa}', 'AdvancedController@advance_address_edit_get_fa');
        Route::get('/advance/address/delete/{id}', 'AdvancedController@advance_address_delete');
        Route::get('/advance/address/delete/{id}/{fa}', 'AdvancedController@advance_address_delete_fa');
        //----------------------------End advance address------------------------------------------------
        //-----------------------------end address-------------------------------------------------------
        //--------------------------start phone number---------------------------------------------------
        Route::get('/phone/show_en', 'GeneralController@phone_number_show_en');
        Route::get('/phone/show_fa/{fa}', 'GeneralController@phone_number_show_fa');
        Route::post('/phone/create', 'GeneralController@phone_number_create');
        Route::get('/phone/create', 'GeneralController@phone_number_create');
        Route::post('/phone/create/{fa}', 'GeneralController@phone_number_create_fa');
        Route::get('/phone/create/{fa}', 'GeneralController@phone_number_create_fa');
        Route::post('/phone/edit/{id}', 'GeneralController@phone_number_edit');
        Route::get('/phone/edit/{id}', 'GeneralController@phone_number_edit');
        Route::post('/phone/edit/{id}/{fa}', 'GeneralController@phone_number_edit_fa');
        Route::get('/phone/edit/{id}/{fa}', 'GeneralController@phone_number_edit_fa');
        Route::get('/phone/delete/{id}', 'GeneralController@phone_number_delete');
        Route::get('/phone/delete/{id}/{fa}', 'GeneralController@phone_number_delete_fa');
        Route::get('/phone/show/{id}/{name}', 'GeneralController@phone_show');
        //----------------------------start option phone number---------------------------------------
        Route::get('/option/phonenumber/show_en', 'OptionController@option_phonenumber_show_en');
        Route::get('/option/phonenumber/show_fa/{fa}', 'OptionController@option_phonenumber_show_fa');
        //----------------------------End option phone number-----------------------------------------
        //-----------------------------start advance phone number-------------------------------------------
        Route::get('/advance/phonenumber/show_en', 'AdvancedController@advance_phonenumber_show_en');
        Route::get('/advance/phonenumber/show_fa/{fa}', 'AdvancedController@advance_phonenumber_show_fa');
        Route::post('/advance/phonenumber/create', 'AdvancedController@advance_phonenumber_create');
        Route::get('/advance/phonenumber/create/{area_code}/{phone}/{read_only_phonenumber}/{hide_field_phonenumber}/{form_id}', 'AdvancedController@advance_phonenumber_create_get');
        Route::post('/advance/phonenumber/create/{fa}', 'AdvancedController@advance_phonenumber_create_fa');
        Route::get('/advance/phonenumber/create/{area_code}/{phone}/{read_only_phonenumber}/{hide_field_phonenumber}/{form_id}/{fa}', 'AdvancedController@advance_phonenumber_create_get_fa');
        Route::get('/advance/phonenumber/show/{id}', 'AdvancedController@advance_phonenumber_show');
        Route::get('/advance/phonenumber/showall/{form_id}', 'AdvancedController@advance_phonenumber_showall');
        Route::post('/advance/phonenumber/edit/{id}/', 'AdvancedController@advance_phonenumber_edit');
        Route::get('/advance/phonenumber/edit/{id}/{area_code}/{phone}/{read_only_phonenumber}/{hide_field_phonenumber}', 'AdvancedController@advance_phonenumber_edit_get');
        Route::post('/advance/phonenumber/edit/{id}/{fa}', 'AdvancedController@advance_phonenumber_edit_fa');
        Route::get('/advance/phonenumber/edit/{id}/{area_code}/{phone}/{read_only_phonenumber}/{hide_field_phonenumber}/{fa}', 'AdvancedController@advance_phonenumber_edit_get_fa');
        Route::get('/advance/phonenumber/delete/{id}', 'AdvancedController@advance_phonenumber_delete');
        Route::get('/advance/phonenumber/delete/{id}/{fa}', 'AdvancedController@advance_phonenumber_delete_fa');
        //-----------------------------End advance phone number-------------------------------------------
        //--------------------------End phone number---------------------------------------------------

        //--------------------------start Date Picker--------------------------------------------------
        Route::get('/datepicker/show_en', 'GeneralController@datepicker_show_en');
        Route::get('/datepicker/show_fa/{fa}', 'GeneralController@datepicker_show_fa');
        Route::post('/datepicker/create', 'GeneralController@datepicker_create');
        Route::get('/datepicker/create', 'GeneralController@datepicker_create');
        Route::post('/datepicker/create/{fa}', 'GeneralController@datepicker_create_fa');
        Route::get('/datepicker/create/{fa}', 'GeneralController@datepicker_create_fa');
        Route::post('/datepicker/edit/{id}', 'GeneralController@datepicker_edit');
        Route::get('/datepicker/edit/{id}', 'GeneralController@datepicker_edit');
        Route::post('/datepicker/edit/{id}/{fa}', 'GeneralController@datepicker_edit_fa');
        Route::get('/datepicker/edit/{id}/{fa}', 'GeneralController@datepicker_edit_fa');
        Route::get('/datepicker/delete/{id}', 'GeneralController@datepicker_delete');
        Route::get('/datepicker/delete/{id}/{fa}', 'GeneralController@datepicker_delete_fa');
        Route::get('/datepicker/show/{id}/{name}', 'GeneralController@datepicker_show');
        //----------------------------start option datepicker---------------------------------------
        Route::get('/option/datepicker/show_en', 'OptionController@option_datepicker_show_en');
        Route::get('/option/datepicker/show_fa/{fa}', 'OptionController@option_datepicker_show_fa');
        Route::post('/option/datepicker/create', 'OptionController@option_datepicker_create');
        Route::get('/option/datepicker/create', 'OptionController@option_datepicker_create');
        Route::post('/option/datepicker/create/{fa}', 'OptionController@option_datepicker_create_fa');
        Route::get('/option/datepicker/create/{fa}', 'OptionController@option_datepicker_create_fa');
        Route::get('/option/datepicker/show/{id}', 'OptionController@option_datepicker_show');
        Route::get('/option/datepicker/showall/{form_id}', 'OptionController@option_datepicker_showall');
        Route::post('/option/datepicker/edit/{id}', 'OptionController@option_datepicker_edit');
        Route::get('/option/datepicker/edit/{id}', 'OptionController@option_datepicker_edit');
        Route::post('/option/datepicker/edit/{id}/{fa}', 'OptionController@option_datepicker_edit_fa');
        Route::get('/option/datepicker/edit/{id}/{fa}', 'OptionController@option_datepicker_edit_fa');
        Route::get('/option/datepicker/delete/{id}', 'OptionController@option_datepicker_delete');
        Route::get('/option/datepicker/delete/{id}/{fa}', 'OptionController@option_datepicker_delete_fa');
        //----------------------------End option datepicker-----------------------------------------
        //--------------------------------start advance datepicker-------------------------------------------
        Route::get('/advance/datepicker/show_en', 'AdvancedController@advance_datepicker_show_en');
        Route::get('/advance/datepicker/show_fa/{fa}', 'AdvancedController@advance_datepicker_show_fa');
        Route::post('/advance/datepicker/create', 'AdvancedController@advance_datepicker_create');
        Route::get('/advance/datepicker/create/{disable_past_date}/{read_only_datepicker}/{hide_field_datepicker}/{form_id}', 'AdvancedController@advance_datepicker_create_get');
        Route::post('/advance/datepicker/create/{fa}', 'AdvancedController@advance_datepicker_create_fa');
        Route::get('/advance/datepicker/create/{disable_past_date}/{read_only_datepicker}/{hide_field_datepicker}/{form_id}/{fa}', 'AdvancedController@advance_datepicker_create_get_fa');
        Route::get('/advance/datepicker/show/{id}', 'AdvancedController@advance_datepicker_show');
        Route::get('/advance/datepicker/showall/{form_id}', 'AdvancedController@advance_datepicker_showall');
        Route::post('/advance/datepicker/edit/{id}/', 'AdvancedController@advance_datepicker_edit');
        Route::get('/advance/datepicker/edit/{id}/{disable_past_date}/{read_only_datepicker}/{hide_field_datepicker}', 'AdvancedController@advance_datepicker_edit_get');
        Route::post('/advance/datepicker/edit/{id}/{fa}', 'AdvancedController@advance_datepicker_edit_fa');
        Route::get('/advance/datepicker/edit/{id}/{disable_past_date}/{read_only_datepicker}/{hide_field_datepicker}/{fa}', 'AdvancedController@advance_datepicker_edit_get_fa');
        Route::get('/advance/datepicker/delete/{id}', 'AdvancedController@advance_datepicker_delete');
        Route::get('/advance/datepicker/delete/{id}/{fa}', 'AdvancedController@advance_datepicker_delete_fa');
        //--------------------------------End advance datepicker-------------------------------------------
        //---------------------------------start time datepicker-----------------------------
        Route::get('/advance/time/datepicker/show_en', 'AdvancedController@time_datepicker_show_en');
        Route::get('/advance/time/datepicker/show_fa/{fa}', 'AdvancedController@time_datepicker_show_fa');
        Route::post('/advance/time/datepicker/create', 'AdvancedController@time_datepicker_create');
        Route::get('/advance/time/datepicker/create/{time_field}/{minute_stepping}/{time_format}/{default_time}/{form_id}', 'AdvancedController@time_datepicker_create_get');
        Route::post('/advance/time/datepicker/create/{fa}', 'AdvancedController@time_datepicker_create_fa');
        Route::get('/advance/time/datepicker/create/{time_field}/{minute_stepping}/{time_format}/{default_time}/{form_id}/{fa}', 'AdvancedController@time_datepicker_create_get_fa');
        Route::get('/advance/time/datepicker/show/{id}', 'AdvancedController@time_datepicker_show');
        Route::get('/advance/time/datepicker/showall/{form_id}', 'AdvancedController@time_datepicker_showall');
        Route::post('/advance/time/datepicker/edit/{id}/', 'AdvancedController@time_datepicker_edit');
        Route::get('/advance/time/datepicker/edit/{id}/{time_field}/{minute_stepping}/{time_format}/{default_time}', 'AdvancedController@time_datepicker_edit_get');
        Route::post('/advance/time/datepicker/edit/{id}/{fa}', 'AdvancedController@time_datepicker_edit_fa');
        Route::get('/advance/time/datepicker/edit/{id}/{time_field}/{minute_stepping}/{time_format}/{default_time}/{fa}', 'AdvancedController@time_datepicker_edit_get_fa');
        Route::get('/advance/time/datepicker/delete/{id}', 'AdvancedController@time_datepicker_delete');
        Route::get('/advance/time/datepicker/delete/{id}/{fa}', 'AdvancedController@time_datepicker_delete_fa');

        //---------------------------------end time datepicker-----------------------------
        //--------------------------End Date Picker--------------------------------------------------
        //--------------------------start timer-----------------------------------------------------
        Route::get('/timer/show_en', 'GeneralController@timer_show_en');
        Route::get('/timer/show_fa/{fa}', 'GeneralController@timer_show_fa');
        Route::post('/timer/create', 'GeneralController@timer_create');
        Route::get('/timer/create', 'GeneralController@timer_create');
        Route::post('/timer/create/{fa}', 'GeneralController@timer_create_fa');
        Route::get('/timer/create/{fa}', 'GeneralController@timer_create_fa');
        Route::post('/timer/edit/{id}', 'GeneralController@timer_edit');
        Route::get('/timer/edit/{id}', 'GeneralController@timer_edit');
        Route::post('/timer/edit/{id}/{fa}', 'GeneralController@timer_edit_fa');
        Route::get('/timer/edit/{id}/{fa}', 'GeneralController@timer_edit_fa');
        Route::get('/timer/delete/{id}', 'GeneralController@timer_delete');
        Route::get('/timer/delete/{id}/{fa}', 'GeneralController@timer_delete_fa');
        Route::get('/timer/show/{id}/{name}', 'GeneralController@timer_show');
        //--------------------------start option timer------------------------------------------------------
        Route::get('/option/timer/show_en', 'OptionController@option_timer_show_en');
        Route::get('/option/timer/show_fa/{fa}', 'OptionController@option_timer_show_fa');
        Route::post('/option/timer/create', 'OptionController@option_timer_create');
        Route::get('/option/timer/create', 'OptionController@option_timer_create');
        Route::post('/option/timer/create/{fa}', 'OptionController@option_timer_create_fa');
        Route::get('/option/timer/create/{fa}', 'OptionController@option_timer_create_fa');
        Route::get('/option/timer/show/{id}', 'OptionController@option_timer_show');
        Route::get('/option/timer/showall/{form_id}', 'OptionController@option_timer_showall');
        Route::post('/option/timer/edit/{id}', 'OptionController@option_timer_edit');
        Route::get('/option/timer/edit/{id}', 'OptionController@option_timer_edit');
        Route::post('/option/timer/edit/{id}/{fa}', 'OptionController@option_timer_edit_fa');
        Route::get('/option/timer/edit/{id}/{fa}', 'OptionController@option_timer_edit_fa');
        Route::get('/option/timer/delete/{id}', 'OptionController@option_timer_edit');
        Route::get('/option/timer/delete/{id}/{fa}', 'OptionController@option_timer_edit_fa');
        //--------------------------End option timer------------------------------------------------------
        //----------------------------start advance timer-------------------------------------------
        Route::get('/advance/timer/show_en', 'AdvancedController@advance_timer_show_en');
        Route::get('/advance/timer/show_fa/{fa}', 'AdvancedController@advance_timer_show_fa');
        Route::post('/advance/timer/create', 'AdvancedController@advance_timer_create');
        Route::get('/advance/timer/create/{read_only_timer}/{hide_field_timer}/{form_id}', 'AdvancedController@advance_timer_create_get');
        Route::post('/advance/timer/create/{fa}', 'AdvancedController@advance_timer_create_fa');
        Route::get('/advance/timer/create/{read_only_timer}/{hide_field_timer}/{form_id}/{fa}', 'AdvancedController@advance_timer_create_get_fa');
        Route::get('/advance/timer/show/{id}', 'AdvancedController@advance_timer_show');
        Route::get('/advance/timer/showall/{form_id}', 'AdvancedController@advance_timer_showall');
        Route::post('/advance/timer/edit/{id}/', 'AdvancedController@advance_timer_edit');
        Route::get('/advance/timer/edit/{id}/{read_only_timer}/{hide_field_timer}/', 'AdvancedController@advance_timer_edit_get');
        Route::post('/advance/timer/edit/{id}/{fa}', 'AdvancedController@advance_timer_edit_fa');
        Route::get('/advance/timer/edit/{id}/{read_only_timer}/{hide_field_timer}/{fa}', 'AdvancedController@advance_timer_edit_get_fa');
        Route::get('/advance/timer/delete/{id}', 'AdvancedController@advance_timer_delete');
        Route::get('/advance/timer/delete/{id}/{fa}', 'AdvancedController@advance_timer_delete_fa');
        //--------------------------------End advance timer-------------------------------------------
        //--------------------------------End timer------------------------------------------------------

        //--------------------------start short text entry------------------------------------------------------
        Route::get('/short_text/show_en', 'GeneralController@short_text_show_en');
        Route::get('/short_text/show_fa/{fa}', 'GeneralController@short_text_show_fa');
        Route::post('/short_text/create', 'GeneralController@short_text_create');
        Route::get('/short_text/create', 'GeneralController@short_text_create');
        Route::post('/short_text/create/{fa}', 'GeneralController@short_text_create_fa');
        Route::get('/short_text/create/{fa}', 'GeneralController@short_text_create_fa');
        Route::post('/short_text/edit/{id}', 'GeneralController@short_text_edit');
        Route::get('/short_text/edit/{id}', 'GeneralController@short_text_edit');
        Route::post('/short_text/edit/{id}/{fa}', 'GeneralController@short_text_edit_fa');
        Route::get('/short_text/edit/{id}/{fa}', 'GeneralController@short_text_edit_fa');
        Route::get('/short_text/delete/{id}', 'GeneralController@short_text_delete');
        Route::get('/short_text/delete/{id}/{fa}', 'GeneralController@short_text_delete_fa');
        Route::get('/short_text/show/{id}/{name}', 'GeneralController@short_text_show');
        //--------------------------start option short text------------------------------------------------------
        Route::get('/option/short_text/show_en', 'OptionController@option_short_text_show_en');
        Route::get('/option/short_text/show_fa/{fa}', 'OptionController@option_short_text_show_fa');
        Route::post('/option/short_text/create', 'OptionController@option_short_text_create');
        Route::get('/option/short_text/create', 'OptionController@option_short_text_create');
        Route::post('/option/short_text/create/{fa}', 'OptionController@option_short_text_create_fa');
        Route::get('/option/short_text/create/{fa}', 'OptionController@option_short_text_create_fa');
        Route::get('/option/short_text/show/{id}', 'OptionController@option_short_text_show');
        Route::get('/option/short_text/showall/{form_id}', 'OptionController@option_short_text_showall');
        Route::post('/option/short_text/edit/{id}', 'OptionController@option_short_text_edit');
        Route::get('/option/short_text/edit/{id}', 'OptionController@option_short_text_edit');
        Route::post('/option/short_text/edit/{id}/{fa}', 'OptionController@option_short_text_edit_fa');
        Route::get('/option/short_text/edit/{id}/{fa}', 'OptionController@option_short_text_edit_fa');
        Route::get('/option/short_text/delete/{id}', 'OptionController@option_short_text_edit');
        Route::get('/option/short_text/delete/{id}/{fa}', 'OptionController@option_short_text_edit_fa');
        //--------------------------------End option short text------------------------------------------------------
        //--------------------------------start advance short text-------------------------------------------
        Route::get('/advance/short_text/show_en', 'AdvancedController@advance_short_text_show_en');
        Route::get('/advance/short_text/show_fa/{fa}', 'AdvancedController@advance_short_text_show_fa');
        Route::post('/advance/short_text/create', 'AdvancedController@advance_short_text_create');
        Route::get('/advance/short_text/create/{placeholder_short}/{default_value_short}/{read_only_short}/{hide_field_short}/{form_id}', 'AdvancedController@advance_short_text_create_get');
        Route::post('/advance/short_text/create/{fa}', 'AdvancedController@advance_short_text_create_fa');
        Route::get('/advance/short_text/create/{placeholder_short}/{default_value_short}/{read_only_short}/{hide_field_short}{form_id}/{fa}', 'AdvancedController@advance_short_text_create_get_fa');
        Route::get('/advance/short_text/show/{id}', 'AdvancedController@advance_short_text_show');
        Route::get('/advance/short_text/showall/{form_id}', 'AdvancedController@advance_short_text_showall');
        Route::post('/advance/short_text/edit/{id}/', 'AdvancedController@advance_short_text_edit');
        Route::get('/advance/short_text/edit/{id}/{placeholder_short}/{default_value_short}/{read_only_short}/{hide_field_short}', 'AdvancedController@advance_short_text_edit_get');
        Route::post('/advance/short_text/edit/{id}/{fa}', 'AdvancedController@advance_short_text_edit_fa');
        Route::get('/advance/short_text/edit/{id}/{placeholder_short}/{default_value_short}/{read_only_short}/{hide_field_short}/{fa}', 'AdvancedController@advance_short_text_edit_get_fa');
        Route::get('/advance/short_text/delete/{id}', 'AdvancedController@advance_short_text_delete');
        Route::get('/advance/short_text/delete/{id}/{fa}', 'AdvancedController@advance_short_text_delete_fa');

        //--------------------------------End advance short text-------------------------------------------
        //--------------------------------End short text entry------------------------------------------------------

        //---------------------------------start Long text ------------------------------------------------------
        Route::get('/long_text/show_en', 'GeneralController@long_text_show_en');
        Route::get('/long_text/show_fa/{fa}', 'GeneralController@long_text_show_fa');
        Route::post('/long_text/create', 'GeneralController@long_text_create');
        Route::get('/long_text/create', 'GeneralController@long_text_create');
        Route::post('/long_text/create/{fa}', 'GeneralController@long_text_create_fa');
        Route::get('/long_text/create/{fa}', 'GeneralController@long_text_create_fa');
        Route::post('/long_text/edit/{id}', 'GeneralController@long_text_edit');
        Route::get('/long_text/edit/{id}', 'GeneralController@long_text_edit');
        Route::post('/long_text/edit/{id}/{fa}', 'GeneralController@long_text_edit_fa');
        Route::get('/long_text/edit/{id}/{fa}', 'GeneralController@long_text_edit_fa');
        Route::get('/long_text/delete/{id}', 'GeneralController@long_text_delete');
        Route::get('/long_text/delete/{id}/{fa}', 'GeneralController@long_text_delete_fa');
        Route::get('/long_text/show/{id}/{name}', 'GeneralController@long_text_show');
        //--------------------------start option long text ------------------------------------------------------
        Route::get('/option/long_text/show_en', 'OptionController@option_long_text_show_en');
        Route::get('/option/long_text/show_fa/{fa}', 'OptionController@option_long_text_show_fa');
        Route::post('/option/long_text/create', 'OptionController@option_long_text_create');
        Route::get('/option/long_text/create', 'OptionController@option_long_text_create');
        Route::post('/option/long_text/create/{fa}', 'OptionController@option_long_text_create_fa');
        Route::get('/option/long_text/create/{fa}', 'OptionController@option_long_text_create_fa');
        Route::get('/option/long_text/show/{id}', 'OptionController@option_long_text_show');
        Route::get('/option/long_text/showall/{form_id}', 'OptionController@option_long_text_showall');
        Route::post('/option/long_text/edit/{id}', 'OptionController@option_long_text_edit');
        Route::get('/option/long_text/edit/{id}', 'OptionController@option_long_text_edit');
        Route::post('/option/long_text/edit/{id}/{fa}', 'OptionController@option_long_text_edit_fa');
        Route::get('/option/long_text/edit/{id}/{fa}', 'OptionController@option_long_text_edit_fa');
        Route::get('/option/long_text/delete/{id}', 'OptionController@option_long_text_edit');
        Route::get('/option/long_text/delete/{id}/{fa}', 'OptionController@option_long_text_edit_fa');
        //--------------------------End option long text ------------------------------------------------------
        //--------------------------------start advance long text-------------------------------------------
        Route::get('/advance/long_text/show_en', 'AdvancedController@advance_long_text_show_en');
        Route::get('/advance/long_text/show_fa/{fa}', 'AdvancedController@advance_long_text_show_fa');
        Route::post('/advance/long_text/create', 'AdvancedController@advance_long_text_create');
        Route::get('/advance/long_text/create/{placeholder_long_text}/{default_value_long_text}/{ready_only_long_text}/{hide_field_long_text}/{form_id}', 'AdvancedController@advance_long_text_create_get');
        Route::post('/advance/long_text/create/{fa}', 'AdvancedController@advance_long_text_create_fa');
        Route::get('/advance/long_text/create/{placeholder_long_text}/{default_value_long_text}/{ready_only_long_text}/{hide_field_long_text}/{form_id}/{fa}', 'AdvancedController@advance_long_text_create_get_fa');
        Route::get('/advance/long_text/show/{id}', 'AdvancedController@advance_long_text_show');
        Route::get('/advance/long_text/showall/{form_id}', 'AdvancedController@advance_long_text_showall');
        Route::post('/advance/long_text/edit/{id}/', 'AdvancedController@advance_long_text_edit');
        Route::get('/advance/long_text/edit/{id}/{placeholder_long_text}/{default_value_long_text}/{ready_only_long_text}/{hide_field_long_text}', 'AdvancedController@advance_long_text_edit_get');
        Route::post('/advance/long_text/edit/{id}/{fa}', 'AdvancedController@advance_long_text_edit_fa');
        Route::get('/advance/long_text/edit/{id}/{placeholder_long_text}/{default_value_long_text}/{ready_only_long_text}/{hide_field_long_text}/{fa}', 'AdvancedController@advance_long_text_edit_get_fa');
        Route::get('/advance/long_text/delete/{id}', 'AdvancedController@advance_long_text_delete');
        Route::get('/advance/long_text/delete/{id}/{fa}', 'AdvancedController@advance_long_text_delete_fa');
        //--------------------------------End advance long text-------------------------------------------
        //--------------------------End Long text ------------------------------------------------------

        //--------------------------start text ------------------------------------------------------
        Route::get('/text/show_en', 'GeneralController@text_show_en');
        Route::get('/text/show_fa/{fa}', 'GeneralController@text_show_fa');
        Route::post('/text/create', 'GeneralController@text_create');
        Route::get('/text/create', 'GeneralController@text_create');
        Route::post('/text/create/{fa}', 'GeneralController@text_create_fa');
        Route::get('/text/create/{fa}', 'GeneralController@text_create_fa');
        Route::post('/text/edit/{id}', 'GeneralController@text_edit');
        Route::get('/text/edit/{id}', 'GeneralController@text_edit');
        Route::post('/text/edit/{id}/{fa}', 'GeneralController@text_edit_fa');
        Route::get('/text/edit/{id}/{fa}', 'GeneralController@text_edit_fa');
        Route::get('/text/delete/{id}', 'GeneralController@text_delete');
        Route::get('/text/delete/{id}/{fa}', 'GeneralController@text_delete_fa');
        Route::get('/text/show/{id}/{name}', 'GeneralController@text_show');
        //--------------------------------start advance  text-------------------------------------------
        Route::get('/advance/text/show_en', 'AdvancedController@advance_text_show_en');
        Route::get('/advance/text/show_fa/{fa}', 'AdvancedController@advance_text_show_fa');
        Route::post('/advance/text/create', 'AdvancedController@advance_text_create');
        Route::get('/advance/text/create/{hide_field_text}/{form_id}', 'AdvancedController@advance_text_create_get');
        Route::post('/advance/text/create/{fa}', 'AdvancedController@advance_text_create_fa');
        Route::get('/advance/text/create/{hide_field_text}/{form_id}/{fa}', 'AdvancedController@advance_text_create_get_fa');
        Route::get('/advance/text/show/{id}', 'AdvancedController@advance_text_show');
        Route::get('/advance/text/showall/{form_id}', 'AdvancedController@advance_text_showall');
        Route::post('/advance/text/edit/{id}/', 'AdvancedController@advance_text_edit');
        Route::get('/advance/text/edit/{id}/{hide_field_text}', 'AdvancedController@advance_text_edit_get');
        Route::post('/advance/text/edit/{id}/{fa}', 'AdvancedController@advance_text_edit_fa');
        Route::get('/advance/text/edit/{id}/{hide_field_text}/{fa}', 'AdvancedController@advance_text_edit_get_fa');
        Route::get('/advance/text/delete/{id}', 'AdvancedController@advance_text_delete');
        Route::get('/advance/text/delete/{id}/{fa}', 'AdvancedController@advance_text_delete_fa');
        //--------------------------------End advance text-------------------------------------------
        //--------------------------End text ------------------------------------------------------

        //--------------------------start dropdown ------------------------------------------------------
        Route::get('/dropdown/show_en', 'GeneralController@dropdown_show_en');
        Route::get('/dropdown/show_fa/{fa}', 'GeneralController@dropdown_show_fa');
        Route::post('/dropdown/create', 'GeneralController@dropdown_create');
        Route::get('/dropdown/create', 'GeneralController@dropdown_create');
        Route::post('/dropdown/create/{fa}', 'GeneralController@dropdown_create_fa');
        Route::get('/dropdown/create/{fa}', 'GeneralController@dropdown_create_fa');
        Route::post('/dropdown/edit/{id}', 'GeneralController@dropdown_edit');
        Route::get('/dropdown/edit/{id}', 'GeneralController@dropdown_edit');
        Route::post('/dropdown/edit/{id}/{fa}', 'GeneralController@dropdown_edit_fa');
        Route::get('/dropdown/edit/{id}/{fa}', 'GeneralController@dropdown_edit_fa');
        Route::get('/dropdown/delete/{id}', 'GeneralController@dropdown_delete');
        Route::get('/dropdown/delete/{id}/{fa}', 'GeneralController@dropdown_delete_fa');
        Route::get('/dropdown/show/{id}/{name}', 'GeneralController@dropdown_show');
        //--------------------------start option dropdown------------------------------------------------------
        Route::get('/option/dropdown/show_en', 'OptionController@option_dropdown_show_en');
        Route::get('/option/dropdown/show_fa/{fa}', 'OptionController@option_dropdown_show_fa');
        Route::post('/option/dropdown/create', 'OptionController@option_dropdown_create');
        Route::get('/option/dropdown/create', 'OptionController@option_dropdown_create');
        Route::post('/option/dropdown/create/{fa}', 'OptionController@option_dropdown_create_fa');
        Route::get('/option/dropdown/create/{fa}', 'OptionController@option_dropdown_create_fa');
        Route::get('/option/dropdown/show/{id}', 'OptionController@option_dropdown_show');
        Route::get('/option/dropdown/showall/{form_id}', 'OptionController@option_dropdown_showall');
        Route::post('/option/dropdown/edit/{id}', 'OptionController@option_dropdown_edit');
        Route::get('/option/dropdown/edit/{id}', 'OptionController@option_dropdown_edit');
        Route::post('/option/dropdown/edit/{id}/{fa}', 'OptionController@option_dropdown_edit_fa');
        Route::get('/option/dropdown/edit/{id}/{fa}', 'OptionController@option_dropdown_edit_fa');
        Route::get('/option/dropdown/delete/{id}', 'OptionController@option_dropdown_edit');
        Route::get('/option/dropdown/delete/{id}/{fa}', 'OptionController@option_dropdown_edit_fa');
        //--------------------------End option dropdown------------------------------------------------------
        //--------------------------start advance dropdown-------------------------------------------
        Route::get('/advance/dropdown/show_en', 'AdvancedController@advance_dropdown_show_en');
        Route::get('/advance/dropdown/show_fa/{fa}', 'AdvancedController@advance_dropdown_show_fa');
        Route::post('/advance/dropdown/create', 'AdvancedController@advance_dropdown_create');
        Route::get('/advance/dropdown/create/{multiple_select}/{shuffle_option}/{hide_field_dropdown}/{form_id}', 'AdvancedController@advance_dropdown_create_get');
        Route::post('/advance/dropdown/create/{fa}', 'AdvancedController@advance_dropdown_create_fa');
        Route::get('/advance/dropdown/create/{multiple_select}/{shuffle_option}/{hide_field_dropdown}/{form_id}/{fa}', 'AdvancedController@advance_dropdown_create_get_fa');
        Route::get('/advance/dropdown/show/{id}', 'AdvancedController@advance_dropdown_show');
        Route::get('/advance/dropdown/showall/{form_id}', 'AdvancedController@advance_dropdown_showall');
        Route::post('/advance/dropdown/edit/{id}', 'AdvancedController@advance_dropdown_edit');
        Route::get('/advance/dropdown/edit/{id}/{multiple_select}/{shuffle_option}/{hide_field_dropdown}', 'AdvancedController@advance_dropdown_edit_get');
        Route::post('/advance/dropdown/edit/{id}/{fa}', 'AdvancedController@advance_dropdown_edit_fa');
        Route::get('/advance/dropdown/edit/{id}/{multiple_select}/{shuffle_option}/{hide_field_dropdown}/{fa}', 'AdvancedController@advance_dropdown_edit_get_fa');
        Route::get('/advance/dropdown/delete/{id}', 'AdvancedController@advance_dropdown_delete');
        Route::get('/advance/dropdown/delete/{id}/{fa}', 'AdvancedController@advance_dropdown_delete_fa');
        //--------------------------------End advance dropdown-------------------------------------------
        //--------------------------------End dropdown------------------------------------------------------

        //--------------------------start single choice ------------------------------------------------------
        Route::get('/single_choice/show_en', 'GeneralController@single_choice_show_en');
        Route::get('/single_choice/show_fa/{fa}', 'GeneralController@single_choice_show_fa');
        Route::post('/single_choice/create', 'GeneralController@single_choice_create');
        Route::get('/single_choice/create', 'GeneralController@single_choice_create');
        Route::post('/single_choice/create/{fa}', 'GeneralController@single_choice_create_fa');
        Route::get('/single_choice/create/{fa}', 'GeneralController@single_choice_create_fa');
        Route::post('/single_choice/edit/{id}', 'GeneralController@single_choice_edit');
        Route::get('/single_choice/edit/{id}', 'GeneralController@single_choice_edit');
        Route::post('/single_choice/edit/{id}/{fa}', 'GeneralController@single_choice_edit_fa');
        Route::get('/single_choice/edit/{id}/{fa}', 'GeneralController@single_choice_edit_fa');
        Route::get('/single_choice/delete/{id}', 'GeneralController@single_choice_delete');
        Route::get('/single_choice/delete/{id}/{fa}', 'GeneralController@single_choice_delete_fa');
        Route::get('/single_choice/show/{id}/{name}', 'GeneralController@single_choice_show');
        //--------------------------start option single choice------------------------------------------------------
        Route::get('/option/single_choice/show_en', 'OptionController@option_single_choice_show_en');
        Route::get('/option/single_choice/show_fa/{fa}', 'OptionController@option_single_choice_show_fa');
        Route::post('/option/single_choice/create', 'OptionController@option_single_choice_create');
        Route::get('/option/single_choice/create', 'OptionController@option_single_choice_create');
        Route::post('/option/single_choice/create/{fa}', 'OptionController@option_single_choice_create_fa');
        Route::get('/option/single_choice/create/{fa}', 'OptionController@option_single_choice_create_fa');
        Route::get('/option/single_choice/gender', 'OptionController@gender');
        Route::get('/option/single_choice/days', 'OptionController@days');
        Route::get('/option/single_choice/months', 'OptionController@months');
        Route::get('/option/single_choice/show/{id}', 'OptionController@option_single_choice_show');
        Route::get('/option/single_choice/showall/{form_id}', 'OptionController@option_single_choice_showall');
        Route::post('/option/single_choice/edit/{id}', 'OptionController@option_single_choice_edit');
        Route::get('/option/single_choice/edit/{id}', 'OptionController@option_single_choice_edit');
        Route::post('/option/single_choice/edit/{id}/{fa}', 'OptionController@option_single_choice_edit_fa');
        Route::get('/option/single_choice/edit/{id}/{fa}', 'OptionController@option_single_choice_edit_fa');
        Route::get('/option/single_choice/delete/{id}', 'OptionController@option_single_choice_edit');
        Route::get('/option/single_choice/delete/{id}/{fa}', 'OptionController@option_single_choice_edit_fa');
        //--------------------------End option single choice------------------------------------------------------
        //--------------------------------start advance single choice-------------------------------------------
        Route::get('/advance/single_choice/show_en', 'AdvancedController@advance_single_choice_show_en');
        Route::get('/advance/single_choice/show_fa/{fa}', 'AdvancedController@advance_single_choice_show_fa');
        Route::post('/advance/single_choice/create', 'AdvancedController@advance_single_choice_create');
        Route::get('/advance/single_choice/create/{select_by_default}/{readonly_single_choice}/{hidefield_single_choice}/{form_id}', 'AdvancedController@advance_single_choice_create_get');
        Route::post('/advance/single_choice/create/{fa}', 'AdvancedController@advance_single_choice_create_fa');
        Route::get('/advance/single_choice/create/{select_by_default}/{readonly_single_choice}/{hidefield_single_choice}/{form_id}/{fa}', 'AdvancedController@advance_single_choice_create_get_fa');
        Route::get('/advance/single_choice/show/{id}', 'AdvancedController@advance_single_choice_show');
        Route::get('/advance/single_choice/showall/{form_id}', 'AdvancedController@advance_single_choice_showall');
        Route::post('/advance/single_choice/edit/{id}', 'AdvancedController@advance_single_choice_edit');
        Route::get('/advance/single_choice/edit/{id}/{select_by_default}/{readonly_single_choice}/{hidefield_single_choice}', 'AdvancedController@advance_single_choice_edit_get');
        Route::post('/advance/single_choice/edit/{id}/{fa}', 'AdvancedController@advance_single_choice_edit_fa');
        Route::get('/advance/single_choice/edit/{id}/{select_by_default}/{readonly_single_choice}/{hidefield_single_choice}/{fa}', 'AdvancedController@advance_single_choice_edit_get_fa');
        Route::get('/advance/single_choice/delete/{id}', 'AdvancedController@advance_single_choice_delete');
        Route::get('/advance/single_choice/delete/{id}/{fa}', 'AdvancedController@advance_single_choice_delete_fa');
        //--------------------------------End advance single choice-------------------------------------------
        //--------------------------------End single choice------------------------------------------------------

        //--------------------------start multiple choice ------------------------------------------------------
        Route::get('/multiple_choice/show_en', 'GeneralController@multiple_choice_show_en');
        Route::get('/multiple_choice/show_fa/{fa}', 'GeneralController@multiple_choice_show_fa');
        Route::post('/multiple_choice/create', 'GeneralController@multiple_choice_create');
        Route::get('/multiple_choice/create', 'GeneralController@multiple_choice_create');
        Route::post('/multiple_choice/create/{fa}', 'GeneralController@multiple_choice_create_fa');
        Route::get('/multiple_choice/create/{fa}', 'GeneralController@multiple_choice_create_fa');
        Route::post('/multiple_choice/edit/{id}', 'GeneralController@multiple_choice_edit');
        Route::get('/multiple_choice/edit/{id}', 'GeneralController@multiple_choice_edit');
        Route::post('/multiple_choice/edit/{id}/{fa}', 'GeneralController@multiple_choice_edit_fa');
        Route::get('/multiple_choice/edit/{id}/{fa}', 'GeneralController@multiple_choice_edit_fa');
        Route::get('/multiple_choice/delete/{id}', 'GeneralController@multiple_choice_delete');
        Route::get('/multiple_choice/delete/{id}/{fa}', 'GeneralController@multiple_choice_delete_fa');
        Route::get('/multiple_choice/show/{id}/{name}', 'GeneralController@multiple_choice_show');
        //-------------------------------------start option multiple choice----------------------------------------
        Route::get('/option/multiple_choice/show_en', 'OptionController@option_multiple_choice_show_en');
        Route::get('/option/multiple_choice/show_fa/{fa}', 'OptionController@option_multiple_choice_show_fa');
        Route::post('/option/multiple_choice/create', 'OptionController@option_multiple_choice_create');
        Route::get('/option/multiple_choice/create', 'OptionController@option_multiple_choice_create');
        Route::post('/option/multiple_choice/create/{fa}', 'OptionController@option_multiple_choice_create_fa');
        Route::get('/option/multiple_choice/create/{fa}', 'OptionController@option_multiple_choice_create_fa');
        Route::get('/option/multiple_choice/gender', 'OptionController@genders');
        Route::get('/option/multiple_choice/days', 'OptionController@dayss');
        Route::get('/option/multiple_choice/months', 'OptionController@monthss');
        Route::get('/option/multiple_choice/show/{id}', 'OptionController@option_multiple_choice_show');
        Route::get('/option/multiple_choice/showall/{form_id}', 'OptionController@option_multiple_choice_showall');
        Route::post('/option/multiple_choice/edit/{id}', 'OptionController@option_multiple_choice_edit');
        Route::get('/option/multiple_choice/edit/{id}', 'OptionController@option_multiple_choice_edit');
        Route::post('/option/multiple_choice/edit/{id}/{fa}', 'OptionController@option_multiple_choice_edit_fa');
        Route::get('/option/multiple_choice/edit/{id}/{fa}', 'OptionController@option_multiple_choice_edit_fa');
        Route::get('/option/multiple_choice/delete/{id}', 'OptionController@option_multiple_choice_edit');
        Route::get('/option/multiple_choice/delete/{id}/{fa}', 'OptionController@option_multiple_choice_edit_fa');
        //-------------------------------------End option multiple choice----------------------------------------
        //--------------------------------start advance multiple choice-------------------------------------------
        Route::get('/advance/multiple_choice/show_en', 'AdvancedController@advance_multiple_choice_show_en');
        Route::get('/advance/multiple_choice/show_fa/{fa}', 'AdvancedController@advance_multiple_choice_show_fa');
        Route::post('/advance/multiple_choice/create', 'AdvancedController@advance_multiple_choice_create');
        Route::get('/advance/multiple_choice/create/{select_by_default_multi}/{ready_only_multi}/{hide_field_multi}/{form_id}', 'AdvancedController@advance_multiple_choice_create_get');
        Route::post('/advance/multiple_choice/create/{fa}', 'AdvancedController@advance_multiple_choice_create_fa');
        Route::get('/advance/multiple_choice/create/{select_by_default_multi}/{ready_only_multi}/{hide_field_multi}/{form_id}/{fa}', 'AdvancedController@advance_multiple_choice_create_get_fa');
        Route::get('/advance/multiple_choice/show/{id}', 'AdvancedController@advance_multiple_choice_show');
        Route::get('/advance/multiple_choice/showall/{form_id}', 'AdvancedController@advance_multiple_choice_showall');
        Route::post('/advance/multiple_choice/edit/{id}', 'AdvancedController@advance_multiple_choice_edit');
        Route::get('/advance/multiple_choice/edit/{id}/{select_by_default_multi}/{ready_only_multi}/{hide_field_multi}', 'AdvancedController@advance_multiple_choice_edit_get');
        Route::post('/advance/multiple_choice/edit/{id}/{fa}', 'AdvancedController@advance_multiple_choice_edit_fa');
        Route::get('/advance/multiple_choice/edit/{id}/{select_by_default_multi}/{ready_only_multi}/{hide_field_multi}/{fa}', 'AdvancedController@advance_multiple_choice_edit_get_fa');
        Route::get('/advance/multiple_choice/delete/{id}', 'AdvancedController@advance_multiple_choice_delete');
        Route::get('/advance/multiple_choice/delete/{id}/{fa}', 'AdvancedController@advance_multiple_choice_delete_fa');
        //--------------------------------End advance multiple choice-------------------------------------------
        //--------------------------------------End multiple choice---------------------------------------------------

        //--------------------------start image choice---------------------------------------------------
        Route::get('/image_choice/show_en', 'GeneralController@image_choice_show_en');
        Route::get('/image_choice/show_fa/{fa}', 'GeneralController@image_choice_show_fa');
        Route::post('/image_choice/create', 'GeneralController@image_choice_create');
        Route::get('/image_choice/create', 'GeneralController@image_choice_create');
        Route::post('/image_choice/create/{fa}', 'GeneralController@image_choice_create_fa');
        Route::get('/image_choice/create/{fa}', 'GeneralController@image_choice_create_fa');
        Route::post('/image_choice/edit/{id}', 'GeneralController@image_choice_edit');
        Route::get('/image_choice/edit/{id}', 'GeneralController@image_choice_edit');
        Route::post('/image_choice/edit/{id}/{fa}', 'GeneralController@image_choice_edit_fa');
        Route::get('/image_choice/edit/{id}/{fa}', 'GeneralController@image_choice_edit_fa');
        Route::get('/image_choice/delete/{id}', 'GeneralController@image_choice_delete');
        Route::get('/image_choice/delete/{id}/{fa}', 'GeneralController@image_choice_delete_fa');
        Route::get('/image_choice/show/{id}/{name}', 'GeneralController@image_choice_show');
        //--------------------------start option image choice---------------------------------------------------
        Route::get('/option/image_choice/show_en', 'OptionController@option_image_choice_show_en');
        Route::get('/option/image_choice/show_fa/{fa}', 'OptionController@option_image_choice_show_fa');
        Route::post('/option/image_choice/create', 'OptionController@option_image_image_choice_create');
        Route::post('/option/image_choice/create/{fa}', 'OptionController@option_image_choice_create_fa');
        Route::post('/option/image_choice/edit/{id}', 'OptionController@option_image_choice_edit');
        Route::post('/option/image_choice/edit/{id}/{fa}', 'OptionController@option_image_choice_edit_fa');
        Route::get('/option/image_choice/delete/{id}', 'OptionController@option_choice_delete');
        Route::get('/option/image_choice/delete/{id}/{fa}', 'OptionController@option_choice_delete_fa');
        Route::get('/option/image_choice/show/{id}', 'OptionController@option_image_choice_show');
        Route::get('/option/image_choice/showall/{form_id}', 'OptionController@option_image_choice_showall');
        //--------------------------end option image choice---------------------------------------------------
        //--------------------------start option image choice---------------------------------------------------
        //--------------------------------start advance image choice-------------------------------------------
        Route::get('/advance/image_choice/show_en', 'AdvancedController@advance_image_choice_show_en');
        Route::get('/advance/image_choice/show_fa/{fa}', 'AdvancedController@advance_image_choice_show_fa');
        Route::post('/advance/image_choice/create', 'AdvancedController@advance_image_choice_create');
        Route::get('/advance/image_choice/create/{ready_only_image}/{hide_field_image}/{form_id}', 'AdvancedController@advance_image_choice_create_get');
        Route::post('/advance/image_choice/create/{fa}', 'AdvancedController@advance_image_choice_create_fa');
        Route::get('/advance/image_choice/create/{ready_only_image}/{hide_field_image}/{form_id}/{fa}', 'AdvancedController@advance_image_choice_create_get_fa');
        Route::get('/advance/image_choice/show/{id}', 'AdvancedController@advance_image_choice_show');
        Route::get('/advance/image_choice/showall/{form_id}', 'AdvancedController@advance_image_choice_showall');
        Route::post('/advance/image_choice/edit/{id}', 'AdvancedController@advance_image_choice_edit');
        Route::get('/advance/image_choice/edit/{id}/{ready_only_image}/{hide_field_image}', 'AdvancedController@advance_image_choice_edit_get');
        Route::post('/advance/image_choice/edit/{id}/{fa}', 'AdvancedController@advance_image_choice_edit_fa');
        Route::get('/advance/image_choice/edit/{id}/{ready_only_image}/{hide_field_image}/{fa}', 'AdvancedController@advance_image_choice_edit_get_fa');
        Route::get('/advance/image_choice/delete/{id}', 'AdvancedController@advance_image_choice_delete');
        Route::get('/advance/image_choice/delete/{id}/{fa}', 'AdvancedController@advance_image_choice_delete_fa');
        //--------------------------------End advance image choice-------------------------------------------
        //--------------------------End image choice---------------------------------------------------

        //--------------------------start number---------------------------------------------------
        Route::get('/number/show_en', 'GeneralController@number_show_en');
        Route::get('/number/show_fa/{fa}', 'GeneralController@number_show_fa');
        Route::post('/number/create', 'GeneralController@number_create');
        Route::get('/number/create', 'GeneralController@number_create');
        Route::post('/number/create/{fa}', 'GeneralController@number_create_fa');
        Route::get('/number/create/{fa}', 'GeneralController@number_create_fa');
        Route::post('/number/edit/{id}', 'GeneralController@number_edit');
        Route::get('/number/edit/{id}', 'GeneralController@number_edit');
        Route::post('/number/edit/{id}/{fa}', 'GeneralController@number_edit_fa');
        Route::get('/number/edit/{id}/{fa}', 'GeneralController@number_edit_fa');
        Route::get('/number/delete/{id}', 'GeneralController@number_delete');
        Route::get('/number/delete/{id}/{fa}', 'GeneralController@number_delete_fa');
        Route::get('/number/show/{id}/{name}', 'GeneralController@number_show');
        //--------------------------start option number---------------------------------------------------
        Route::get('/option/number/show_en', 'OptionController@option_number_show_en');
        Route::get('/option/number/show_fa/{fa}', 'OptionController@option_number_show_fa');
        Route::post('/option/number/create', 'OptionController@option_number_create');
        Route::get('/option/number/create/{minumum}/{maximum}/{form_id}', 'OptionController@option_number_create_get');
        Route::post('/option/number/create/{fa}', 'OptionController@option_number_create_fa');
        Route::get('/option/number/create/{minumum}/{maximum}/{form_id}/{fa}', 'OptionController@option_number_create_fa_get');
        Route::get('/option/number/show/{id}', 'OptionController@option_number_show');
        Route::get('/option/number/showall/{form_id}', 'OptionController@option_number_showall');
        Route::post('/option/number/edit/{id}', 'OptionController@option_number_edit');
        Route::get('/option/number/edit/{minumum}/{maximum}/{id}', 'OptionController@option_number_edit_get');
        Route::post('/option/number/edit/{id}/{fa}', 'OptionController@option_number_edit_fa');
        Route::get('/option/number/edit/{id}/{minumum}/{maximum}/{fa}', 'OptionController@option_number_edit_get_fa');
        Route::get('/option/number/delete/{id}', 'OptionController@option_number_delete');
        Route::get('/option/number/delete/{id}/{fa}', 'OptionController@option_number_delete_fa');
        //---------------------------------End option number---------------------------------------------------
        //--------------------------------start advance number-------------------------------------------
        Route::get('/advance/number/show_en', 'AdvancedController@advance_number_show_en');
        Route::get('/advance/number/show_fa/{fa}', 'AdvancedController@advance_number_show_fa');
        Route::post('/advance/number/create', 'AdvancedController@advance_number_create');
        Route::get('/advance/number/create/{placeholder}/{default_value}/{readonly}/{hidefield}/{form_id}', 'AdvancedController@advance_number_create_get');
        Route::post('/advance/number/create/{fa}', 'AdvancedController@advance_number_create_fa');
        Route::get('/advance/number/create/{placeholder}/{default_value}/{readonly}/{hidefield}/{form_id}/{fa}', 'AdvancedController@advance_number_create_get_fa');
        Route::get('/advance/number/show/{id}', 'AdvancedController@advance_number_show');
        Route::get('/advance/number/showall/{form_id}', 'AdvancedController@advance_number_showall');
        Route::post('/advance/number/edit/{id}', 'AdvancedController@advance_number_edit');
        Route::get('/advance/number/edit/{id}/{placeholder}/{default_value}/{readonly}/{hidefield}', 'AdvancedController@advance_number_edit_get');
        Route::post('/advance/number/edit/{id}/{fa}', 'AdvancedController@advance_number_edit_fa');
        Route::get('/advance/number/edit/{id}/{placeholder}/{default_value}/{readonly}/{hidefield}/{fa}', 'AdvancedController@advance_number_edit_get_fa');
        Route::get('/advance/number/delete/{id}', 'AdvancedController@advance_number_delete');
        Route::get('/advance/number/delete/{id}/{fa}', 'AdvancedController@advance_number_delete_fa');
        //--------------------------------End advance number-------------------------------------------
        //---------------------------------End number-------------------------------------------------------

        //--------------------------start image---------------------------------------------------
        Route::get('/image/show_en', 'GeneralController@image_show_en');
        Route::get('/image/show_fa/{fa}', 'GeneralController@image_show_fa');
        Route::post('/image/create', 'GeneralController@image_create');
        Route::get('/image/create', 'GeneralController@image_create');
        Route::post('/image/create/{fa}', 'GeneralController@image_create_fa');
        Route::get('/image/create/{fa}', 'GeneralController@image_create_fa');
        Route::post('/image/edit/{id}', 'GeneralController@image_edit');
        Route::get('/image/edit/{id}', 'GeneralController@image_edit');
        Route::post('/image/edit/{id}/{fa}', 'GeneralController@image_edit_fa');
        Route::get('/image/edit/{id}/{fa}', 'GeneralController@image_edit_fa');
        Route::get('/image/delete/{id}', 'GeneralController@image_delete');
        Route::get('/image/delete/{id}/{fa}', 'GeneralController@image_delete_fa');
        Route::get('/image/show/{id}/{name}', 'GeneralController@image_show');
        //--------------------------------start advance image-------------------------------------------
        Route::get('/advance/image/show_en', 'AdvancedController@advance_image_show_en');
        Route::get('/advance/image/show_fa/{fa}', 'AdvancedController@advance_image_show_fa');
        Route::post('/advance/image/create', 'AdvancedController@advance_image_create');
        Route::get('/advance/image/create/{alternative_text}/{link_image}/{file_reference}/{hidefield_image}/{form_id}', 'AdvancedController@advance_image_create_get');
        Route::post('/advance/image/create/{fa}', 'AdvancedController@advance_image_create_fa');
        Route::get('/advance/image/create/{alternative_text}/{link_image}/{file_reference}/{hidefield_image}/{form_id}/{fa}', 'AdvancedController@advance_image_create_get_fa');
        Route::get('/advance/image/show/{id}', 'AdvancedController@advance_image_show');
        Route::get('/advance/image/showall/{form_id}', 'AdvancedController@advance_image_showall');
        Route::post('/advance/image/edit/{id}', 'AdvancedController@advance_image_edit');
        Route::get('/advance/image/edit/{id}/{alternative_text}/{link_image}/{file_reference}/{hidefield_image}', 'AdvancedController@advance_image_get');
        Route::post('/advance/image/edit/{id}/{fa}', 'AdvancedController@advance_image_edit_fa');
        Route::get('/advance/image/edit/{id}/{alternative_text}/{link_image}/{file_reference}/{hidefield_image}/{fa}', 'AdvancedController@advance_image_get_fa');
        Route::get('/advance/image/delete/{id}', 'AdvancedController@advance_image_delete');
        Route::get('/advance/image/delete/{id}/{fa}', 'AdvancedController@advance_image_delete_fa');
        //--------------------------------End advance image-------------------------------------------
        //--------------------------------End image---------------------------------------------------

        //--------------------------start file upload---------------------------------------------------
        Route::get('/file_upload/show_en', 'GeneralController@file_upload_show_en');
        Route::get('/file_upload/show_fa/{fa}', 'GeneralController@file_upload_show_fa');
        Route::post('/file_upload/create', 'GeneralController@file_upload_create');
        Route::get('/file_upload/create', 'GeneralController@file_upload_create');
        Route::post('/file_upload/create/{fa}', 'GeneralController@file_upload_create_fa');
        Route::get('/file_upload/create/{fa}', 'GeneralController@file_upload_create_fa');
        Route::post('/file_upload/edit/{id}', 'GeneralController@file_upload_edit');
        Route::get('/file_upload/edit/{id}', 'GeneralController@file_upload_edit');
        Route::post('/file_upload/edit/{id}/{fa}', 'GeneralController@file_upload_edit_fa');
        Route::get('/file_upload/edit/{id}/{fa}', 'GeneralController@file_upload_edit_fa');
        Route::get('/file_upload/delete/{id}', 'GeneralController@file_upload_delete');
        Route::get('/file_upload/delete/{id}/{fa}', 'GeneralController@file_upload_delete_fa');
        Route::get('/file_upload/show/{id}/{name}', 'GeneralController@file_upload_show');
        //--------------------------start option file upload---------------------------------------------------
        Route::get('/option/fileupload/show_en', 'OptionController@option_fileupload_show_en');
        Route::get('/option/fileupload/show_fa/{fa}', 'OptionController@option_fileupload_show_fa');
        Route::post('/option/fileupload/create', 'OptionController@option_fileupload_create');
        Route::get('/option/fileupload/create_get/{minumum}/{maximum}/{filetype}/{form_id}', 'OptionController@option_fileupload_create_get');
        Route::post('/option/fileupload/create/{fa}', 'OptionController@option_fileupload_create_fa');
        Route::get('/option/fileupload/create_get/{minumum_fileupload}/{maximumfileupload}/{filetype}/{form_id}/{fa}', 'OptionController@option_fileupload_create_get_fa');
        Route::get('/option/fileupload/show/{id}', 'OptionController@option_fileupload_show');
        Route::get('/option/fileupload/showall/{form_id}', 'OptionController@option_fileupload_showall');
        Route::post('/option/fileupload/edit/{id}', 'OptionController@option_fileupload_edit');
        Route::get('/option/fileupload/edit/{minumum}/{maximum}/{filetype}/{id}', 'OptionController@option_fileupload_edit_get');
        Route::post('/option/fileupload/edit/{id}/{fa}', 'OptionController@option_fileupload_edit_fa');
        Route::get('/option/fileupload/edit/{minumum}/{maximum}/{id}/{fa}', 'OptionController@option_fileupload_edit_get_fa');
        Route::get('/option/fileupload/delete/{id}', 'OptionController@option_fileupload_delete');
        Route::get('/option/fileupload/delete/{id}/{fa}', 'OptionController@option_fileupload_delete_fa');
        //--------------------------End option file upload---------------------------------------------------
        //--------------------------------start advance fileupload-------------------------------------------
        Route::get('/advance/fileupload/show_en', 'AdvancedController@advance_fileupload_show_en');
        Route::get('/advance/fileupload/show_fa/{fa}', 'AdvancedController@advance_fileupload_show_fa');
        Route::post('/advance/fileupload/create', 'AdvancedController@advance_fileupload_create');
        Route::get('/advance/fileupload/create/{hidefield_fileupload}/{form_id}', 'AdvancedController@advance_fileupload_create_get');
        Route::post('/advance/fileupload/create/{fa}', 'AdvancedController@advance_fileupload_create_fa');
        Route::get('/advance/fileupload/create/{hidefield_fileupload}/{form_id}/{fa}', 'AdvancedController@advance_fileupload_create_get_fa');
        Route::get('/advance/fileupload/show/{id}', 'AdvancedController@advance_fileupload_show');
        Route::get('/advance/fileupload/showall/{form_id}', 'AdvancedController@advance_fileupload_showall');
        Route::post('/advance/fileupload/edit/{id}', 'AdvancedController@advance_fileupload_edit');
        Route::get('/advance/fileupload/edit/{id}/{hidefield_fileupload}', 'AdvancedController@advance_fileupload_get');
        Route::post('/advance/fileupload/edit/{id}/{fa}', 'AdvancedController@advance_fileupload_edit_fa');
        Route::get('/advance/fileupload/edit/{id}/{hidefield_fileupload}/{fa}', 'AdvancedController@advance_fileupload_get_fa');
        Route::get('/advance/fileupload/delete/{id}', 'AdvancedController@advance_fileupload_delete');
        Route::get('/advance/fileupload/delete/{id}/{fa}', 'AdvancedController@advance_fileupload_delete_fa');
        //--------------------------------End advance fileupload-------------------------------------------
        //--------------------------------End file upload---------------------------------------------------

        //--------------------------start captcha---------------------------------------------------
        Route::get('/captcha/show_en', 'GeneralController@captcha_show_en');
        Route::get('/captcha/show_fa/{fa}', 'GeneralController@captcha_show_fa');
        Route::post('/captcha/create', 'GeneralController@captcha_create');
        Route::get('/captcha/create', 'GeneralController@captcha_create');
        Route::post('/captcha/create/{fa}', 'GeneralController@captcha_create_fa');
        Route::get('/captcha/create/{fa}', 'GeneralController@captcha_create_fa');
        Route::post('/captcha/edit/{id}', 'GeneralController@captcha_edit');
        Route::get('/captcha/edit/{id}', 'GeneralController@captcha_edit');
        Route::post('/captcha/edit/{id}/{fa}', 'GeneralController@captcha_edit_fa');
        Route::get('/captcha/edit/{id}/{fa}', 'GeneralController@captcha_edit_fa');
        Route::get('/captcha/delete/{id}', 'GeneralController@captcha_delete');
        Route::get('/captcha/delete/{id}/{fa}', 'GeneralController@captcha_delete_fa');
        Route::get('/captcha/show/{id}/{name}', 'GeneralController@captcha_show');

        //--------------------------End captcha---------------------------------------------------
        //--------------------------start input table---------------------------------------------------
        Route::get('/input_table/show_en', 'GeneralController@input_table_show_en');
        Route::get('/input_table/show_fa/{fa}', 'GeneralController@input_table_show_fa');
        Route::post('/input_table/create', 'GeneralController@input_table_create');
        Route::get('/input_table/create', 'GeneralController@input_table_create');
        Route::post('/input_table/create/{fa}', 'GeneralController@input_table_create_fa');
        Route::get('/input_table/create/{fa}', 'GeneralController@input_table_create_fa');
        Route::post('/input_table/edit/{id}', 'GeneralController@input_table_edit');
        Route::get('/input_table/edit/{id}', 'GeneralController@input_table_edit');
        Route::post('/input_table/edit/{id}/{fa}', 'GeneralController@input_table_edit_fa');
        Route::get('/input_table/edit/{id}/{fa}', 'GeneralController@input_table_edit_fa');
        Route::get('/input_table/delete/{id}', 'GeneralController@input_table_delete');
        Route::get('/input_table/delete/{id}/{fa}', 'GeneralController@input_table_delete_fa');
        Route::get('/input_table/show/{id}/{name}', 'GeneralController@input_table_show');
        //--------------------------------start advance input-------------------------------------------
        Route::get('/advance/input_table/show_en', 'AdvancedController@advance_input_table_show_en');
        Route::get('/advance/input_table/show_fa/{fa}', 'AdvancedController@advance_input_table_show_fa');
        Route::post('/advance/input_table/create', 'AdvancedController@advance_input_table_create');
        Route::get('/advance/input_table/create/{hidefield_input}/{form_id}', 'AdvancedController@advance_input_table_create_get');
        Route::post('/advance/input_table/create/{fa}', 'AdvancedController@advance_input_table_create_fa');
        Route::get('/advance/input_table/create/{hidefield_input}/{form_id}/{fa}', 'AdvancedController@advance_input_table_create_get_fa');
        Route::get('/advance/input_table/show/{id}', 'AdvancedController@advance_input_table_show');
        Route::get('/advance/input_table/showall/{form_id}', 'AdvancedController@advance_input_table_showall');
        Route::post('/advance/input_table/edit/{id}', 'AdvancedController@advance_input_table_edit');
        Route::get('/advance/input_table/edit/{id}/{hidefield_input}', 'AdvancedController@advance_input_table_get');
        Route::post('/advance/input_table/edit/{id}/{fa}', 'AdvancedController@advance_input_table_edit_fa');
        Route::get('/advance/input_table/edit/{id}/{hidefield_input}/{fa}', 'AdvancedController@advance_input_table_get_fa');
        Route::get('/advance/input_table/delete/{id}', 'AdvancedController@advance_input_table_delete');
        Route::get('/advance/input_table/delete/{id}/{fa}', 'AdvancedController@advance_input_table_delete_fa');
        //--------------------------------End advance input-------------------------------------------
        //-------------------------------End input table---------------------------------------------------
        //--------------------------------start emoji---------------------------------------------------
        Route::get('/emoji/show_en', 'GeneralController@emoji_show_en');
        Route::get('/emoji/show_fa/{fa}', 'GeneralController@emoji_show_fa');
        Route::post('/emoji/create', 'GeneralController@emoji_create');
        Route::get('/emoji/create', 'GeneralController@emoji_create');
        Route::post('/emoji/create/{fa}', 'GeneralController@emoji_create_fa');
        Route::get('/emoji/create/{fa}', 'GeneralController@emoji_create_fa');
        Route::post('/emoji/edit/{id}', 'GeneralController@emoji_edit');
        Route::get('/emoji/edit/{id}', 'GeneralController@emoji_edit');
        Route::post('/emoji/edit/{id}/{fa}', 'GeneralController@emoji_edit_fa');
        Route::get('/emoji/edit/{id}/{fa}', 'GeneralController@emoji_edit_fa');
        Route::get('/emoji/delete/{id}', 'GeneralController@emoji_delete');
        Route::get('/emoji/delete/{id}/{fa}', 'GeneralController@emoji_delete_fa');
        Route::get('/emoji/show/{id}/{name}', 'GeneralController@emoji_show');
        //--------------------------------start advance emoji-------------------------------------------
        Route::get('/advance/emoji/show_en', 'AdvancedController@advance_emoji_show_en');
        Route::get('/advance/emoji/show_fa/{fa}', 'AdvancedController@advance_emoji_show_fa');
        Route::post('/advance/emoji/create', 'AdvancedController@advance_emoji_create');
        Route::get('/advance/emoji/create/{hidefield_emoji}/{form_id}', 'AdvancedController@advance_emoji_create_get');
        Route::post('/advance/emoji/create/{fa}', 'AdvancedController@advance_emoji_create_fa');
        Route::get('/advance/emoji/create/{hidefield_emoji}/{form_id}/{fa}', 'AdvancedController@advance_emoji_create_get_fa');
        Route::get('/advance/emoji/show/{id}', 'AdvancedController@advance_emoji_show');
        Route::get('/advance/emoji/showall/{form_id}', 'AdvancedController@advance_emoji_showall');
        Route::post('/advance/emoji/edit/{id}', 'AdvancedController@advance_emoji_edit');
        Route::get('/advance/emoji/edit/{id}/{hidefield_emoji}', 'AdvancedController@advance_emoji_get');
        Route::post('/advance/emoji/edit/{id}/{fa}', 'AdvancedController@advance_emoji_edit_fa');
        Route::get('/advance/emoji/edit/{id}/{hidefield_emoji}/{fa}', 'AdvancedController@advance_emoji_get_fa');
        Route::get('/advance/emoji/delete/{id}', 'AdvancedController@advance_emoji_delete');
        Route::get('/advance/emoji/delete/{id}/{fa}', 'AdvancedController@advance_emoji_delete_fa');
        //--------------------------------End advance emoji-------------------------------------------
        //-------------------------------End emoji---------------------------------------------------

        //--------------------------start Star Rating---------------------------------------------------
        Route::get('/Star_Rating/show_en', 'GeneralController@Star_Rating_show_en');
        Route::get('/Star_Rating/show_fa/{fa}', 'GeneralController@Star_Rating_show_fa');
        Route::post('/Star_Rating/create', 'GeneralController@Star_Rating_create');
        Route::get('/Star_Rating/create', 'GeneralController@Star_Rating_create');
        Route::post('/Star_Rating/create/{fa}', 'GeneralController@Star_Rating_create_fa');
        Route::get('/Star_Rating/create/{fa}', 'GeneralController@Star_Rating_create_fa');
        Route::post('/Star_Rating/edit/{id}', 'GeneralController@Star_Rating_edit');
        Route::get('/Star_Rating/edit/{id}', 'GeneralController@Star_Rating_edit');
        Route::post('/Star_Rating/edit/{id}/{fa}', 'GeneralController@Star_Rating_edit_fa');
        Route::get('/Star_Rating/edit/{id}/{fa}', 'GeneralController@Star_Rating_edit_fa');
        Route::get('/Star_Rating/delete/{id}', 'GeneralController@Star_Rating_delete');
        Route::get('/Star_Rating/delete/{id}/{fa}', 'GeneralController@Star_Rating_delete_fa');
        Route::get('/Star_Rating/show/{id}/{name}', 'GeneralController@Star_Rating_show');
        //--------------------------star option  Star Rating---------------------------------------------------
        Route::get('/option/Star_Rating/show_en', 'OptionController@option_Star_Rating_show_en');
        Route::get('/option/Star_Rating/show_fa/{fa}', 'OptionController@option_Star_Rating_show_fa');
        Route::post('/option/Star_Rating/create', 'OptionController@option_Star_Rating_create');
        Route::get('/option/Star_Rating/create_get/{ratihn_style}/{lowest}/{rating_amount}/{lowest_rating_text}/{highest_rating}/{form_id}', 'OptionController@option_Star_Rating_create_get');
        Route::post('/option/Star_Rating/create/{fa}', 'OptionController@option_Star_Rating_create_fa');
        Route::get('/option/Star_Rating/create_get/{ratihn_style}/{lowest}/{rating_amount}/{lowest_rating_text}/{highest_rating}/{form_id}/{fa}', 'OptionController@option_Star_Rating_create_get_fa');
        Route::get('/option/Star_Rating/show/{id}', 'OptionController@option_Star_Rating_show');
        Route::get('/option/Star_Rating/showall/{form_id}', 'OptionController@option_Star_Rating_showall');
        Route::post('/option/Star_Rating/edit/{id}', 'OptionController@option_Star_Rating_edit');
        Route::get('/option/Star_Rating/edit/{id}/{ratihn_style}/{lowest}/{rating_amount}/{lowest_rating_text}/{highest_rating}', 'OptionController@option_Star_Rating_edit_get');
        Route::post('/option/Star_Rating/edit/{id}/{fa}', 'OptionController@option_Star_Rating_edit_fa');
        Route::get('/option/Star_Rating/edit/{id}/{ratihn_style}/{lowest}/{rating_amount}/{lowest_rating_text}/{highest_rating}/{fa}', 'OptionController@option_Star_Rating_edit_get_fa');
        Route::get('/option/Star_Rating/delete/{id}', 'OptionController@option_Star_Rating_delete');
        Route::get('/option/Star_Rating/delete/{id}/{fa}', 'OptionController@option_Star_Rating_delete_fa');
        //--------------------------End option Star Rating---------------------------------------------------
        //--------------------------------start advance start-------------------------------------------
        Route::get('/advance/Star_Rating/show_en', 'AdvancedController@advance_Star_Rating_show_en');
        Route::get('/advance/Star_Rating/show_fa/{fa}', 'AdvancedController@advance_Star_Rating_show_fa');
        Route::post('/advance/Star_Rating/create', 'AdvancedController@advance_Star_Rating_create');
        Route::get('/advance/Star_Rating/create/{default_value_start}/{hidefield_start}/{form_id}', 'AdvancedController@advance_Star_Rating_create_get');
        Route::post('/advance/Star_Rating/create/{fa}', 'AdvancedController@advance_Star_Rating_create_fa');
        Route::get('/advance/Star_Rating/create/{default_value_start}/{hidefield_start}/{form_id}/{fa}', 'AdvancedController@advance_Star_Rating_create_get_fa');
        Route::get('/advance/Star_Rating/show/{id}', 'AdvancedController@advance_Star_Rating_show');
        Route::get('/advance/Star_Rating/showall/{form_id}', 'AdvancedController@advance_Star_Rating_showall');
        Route::post('/advance/Star_Rating/edit/{id}', 'AdvancedController@advance_Star_Rating_edit');
        Route::get('/advance/Star_Rating/edit/{id}/{default_value_start}/{hidefield_start}', 'AdvancedController@advance_Star_Rating_get');
        Route::post('/advance/Star_Rating/edit/{id}/{fa}', 'AdvancedController@advance_Star_Rating_edit_fa');
        Route::get('/advance/Star_Rating/edit/{id}/{default_value_start}/{hidefield_start}/{fa}', 'AdvancedController@advance_Star_Rating_get_fa');
        Route::get('/advance/Star_Rating/delete/{id}', 'AdvancedController@advance_Star_Rating_delete');
        Route::get('/advance/Star_Rating/delete/{id}/{fa}', 'AdvancedController@advance_Star_Rating_delete_fa');
        //--------------------------------End advance start-------------------------------------------
        //--------------------------------End Star Rating---------------------------------------------------
        //--------------------------------------------------------------------------------------------
        //--------------------------------------------------------------------------------------------
        //--------------------------------Setting------------------------------------------------
        Route::get('/setting/show_en', 'OtherController@setting_show_en');
        Route::get('/setting/show_fa/{fa}', 'OtherController@setting_show_fa');
        Route::post('/setting/create', 'OtherController@setting_create');
        Route::post('/setting/edit/{id}', 'OtherController@setting_edit');
        Route::post('/setting/delete/{id}', 'OtherController@setting_delete');
        Route::get('/setting/email', 'OtherController@setting_email');
        Route::post('/setting/renamepass', 'OtherController@rename_pass');
        Route::post('/setting/page_title/{id}', 'OtherController@page_title');
        Route::post('/setting/country', 'OtherController@all');
        Route::post('/setting/country1', 'OtherController@all_values');
        Route::post('/setting/country2', 'OtherController@all_keys');
        Route::post('/setting/country3', 'OtherController@all1');
        Route::post('/setting/continue_forms_later/{form_id}', 'OtherController@Continue_Forms_Later');
        Route::post('/setting/unique_submission/{form_id}', 'OtherController@unique_submission');

        //--------------------------------start Setting show/hide----------------------------------------
        Route::get('/setting/showhide/type_name/{form_id}', 'ShowhideController@type_name');
        Route::get('/setting/showhide/show', 'ShowhideController@setting_showhide');
        Route::post('/setting/showhide/create', 'ShowhideController@setting_show_hide_create');
        Route::post('/setting/showhide/edit/{id}', 'ShowhideController@setting_show_hide_edit');
        Route::get('/setting/showhide/show/{form_id}', 'ShowhideController@setting_show_hide_show');
        Route::get('/setting/showhide/delete/{id}', 'ShowhideController@setting_show_hide_delete');
        //---------------------------------end setting show/hide----------------------------------------
        //--------------------------------start Setting update----------------------------------------
        Route::get('/setting/update/show', 'ShowhideController@setting_update_show');
        Route::post('/setting/update/create', 'ShowhideController@setting_update_create');
        Route::post('/setting/update/edit/{id}', 'ShowhideController@setting_update_edit');
        Route::get('/setting/update/show/{form_id}', 'ShowhideController@setting_update1_show');
        Route::get('/setting/update/delete/{id}', 'ShowhideController@setting_update_delete');
        //---------------------------------end setting update----------------------------------------
        //--------------------------------start Setting enable----------------------------------------
        Route::get('/setting/enable/show', 'ShowhideController@setting_enable_show');
        Route::post('/setting/enable/create', 'ShowhideController@setting_enable_create');
        Route::post('/setting/enable/edit/{id}', 'ShowhideController@setting_enable_edit');
        Route::get('/setting/enable/show/{form_id}', 'ShowhideController@setting_enable1_show');
        Route::get('/setting/enable/delete/{id}', 'ShowhideController@setting_enable_delete');
        //---------------------------------end setting enable----------------------------------------
        //--------------------------------start Setting skip----------------------------------------
        Route::get('/setting/skip/show', 'ShowhideController@setting_skip_show');
        Route::post('/setting/skip/create', 'ShowhideController@setting_skip_create');
        Route::post('/setting/skip/edit/{id}', 'ShowhideController@setting_skip_edit');
        Route::get('/setting/skip/show/{form_id}', 'ShowhideController@setting_skip1_show');
        Route::get('/setting/skip/delete/{id}', 'ShowhideController@setting_skip_delete');
        //---------------------------------end setting skip----------------------------------------
        //--------------------------------start Setting change----------------------------------------
        Route::get('/setting/change/show', 'ShowhideController@setting_change_show');
        Route::post('/setting/change/create', 'ShowhideController@setting_change_create');
        Route::post('/setting/change/edit/{id}', 'ShowhideController@setting_change_edit');
        Route::get('/setting/change/show/{form_id}', 'ShowhideController@setting_change1_show');
        Route::get('/setting/change/delete/{id}', 'ShowhideController@setting_change_delete');
        //---------------------------------end setting change----------------------------------------
        //--------------------------------start Setting change----------------------------------------
        Route::get('/setting/changeemail/show', 'ShowhideController@setting_changeemail_show');
        Route::post('/setting/changeemail/create', 'ShowhideController@setting_changeemail_create');
        Route::post('/setting/changeemail/edit/{id}', 'ShowhideController@setting_changeemail_edit');
        Route::get('/setting/changeemail/show/{form_id}', 'ShowhideController@setting_changeemail_show');
        Route::get('/setting/changeemail/delete/{id}', 'ShowhideController@setting_changeemail_delete');
        //---------------------------------end setting change----------------------------------------
        //--------------------------------start publish----------------------------------------------
        Route::get('/setting/publish/show', 'PublishController@show');
        Route::get('/setting/publish/sharing_twitter', 'PublishController@sharing_twitter');
        Route::get('/setting/publish/sharing_facebook', 'PublishController@sharing_facebook');
        Route::get('/setting/publish/embed', 'PublishController@embed');
        Route::get('/setting/publish/iframe', 'PublishController@iframe');

        //--------------------------------end publish------------------------------------------------
        //------------------------------start form design--------------------------------------------
        Route::post('/color', 'FormdesignerController@color');//create
        Route::post('/color/edit/{id}', 'FormdesignerController@color_edit');
        Route::post('/color/delete/{id}', 'FormdesignerController@color_delete');
        Route::post('/color/show/{id}', 'FormdesignerController@color_show');

        Route::post('/image', 'FormdesignerController@image');
        Route::post('/image/edit/{id}', 'FormdesignerController@image_edit');
        Route::post('/image/delete/{id}', 'FormdesignerController@image_delete');
        Route::post('/image/show/{id}', 'FormdesignerController@image_show');

        Route::post('/video', 'FormdesignerController@video');
        Route::post('/video/edit/{id}', 'FormdesignerController@video_edit');
        Route::post('/video/delete/{id}', 'FormdesignerController@video_delete');
        Route::post('/video/show/{id}', 'FormdesignerController@video_show');
        //------------------------------end form design----------------------------------------------
        //------------------------------Element form --------------------------------------------------
        Route::post('/element/{id}/{element_id}', 'ElementformController@sort_element');
        Route::post('/element1/show1/{form_id}', 'ElementformController@show_sort_element');
        Route::post('/element1/id/{form_id}', 'ElementformController@show_sort_element_id');
        Route::post('/element1/element_id/{form_id}', 'ElementformController@show_sort_element_element_id');
        Route::post('/element1/element_name/{form_id}', 'ElementformController@show_sort_element_element_name');
        Route::post('/element1/edit/{form_id}', 'ElementformController@edit_element');
//        Route::post('/element1/edit_order/{form_id}/{id}', 'ElementformController@showinfo_for_as_id');
        Route::post('/element1/edit_order/{form_id}/{id}', 'ElementformController@edit_element_order');
        Route::post('/element1/edit1/{form_id}', 'ElementformController@edit_element1');
        Route::post('/element1/delete/{id}/{form_id}', 'ElementformController@delete_element');
        //------------------------------end Element form -----------------------------------------------
        //------------------------------form designer easy-------------------------------------------------
        //-------------------------------colors-------------------------------------------------------
        Route::post('/colors/create','ColorsController@colors');
        Route::post('/colors/show/{id}','ColorsController@colors_show');
        Route::post('/colors/edit/{id}','ColorsController@colors_edit');
        Route::post('/colors/edit1/{form_id}','ColorsController@colors_edit1');
        Route::post('/colors/delete/{id}','ColorsController@colors_delete');
        Route::post('/colors/form_id/{form_id}','ColorsController@colors_form_id');

        //--------------------------------end colors--------------------------------------------------
        //--------------------------------start style-------------------------------------------------

        Route::post('/style/font','ColorsController@font');
        Route::post('/style/create','ColorsController@style');
        Route::post('/style/show/{form_id}','ColorsController@style_show');
        Route::post('/style/edit/{id}','ColorsController@style_edit');
        Route::post('/style/edit1/{form_id}','ColorsController@style_edit1');
        Route::post('/style/delete/{id}','ColorsController@style_delete');
//        Route::post('/style/form_id/{id}','ColorsController@style_form_id');

        //--------------------------------end style--------------------------------------------------
        //--------------------------------start css-----------------------------------------------------
        Route::post('/css/create','ColorsController@css');
        Route::post('/css/show/{id}','ColorsController@css_show');
        Route::post('/css/show1/{form_id}','ColorsController@css_show1');
        Route::post('/css/edit/{id}','ColorsController@css_edit');
        Route::post('/css/edit1/{form_id}','ColorsController@css_edit1');
        Route::post('/css/delete/{id}','ColorsController@css_delete');
        //--------------------------------end css--------------------------------------------------------
        //--------------------------------start thems-----------------------------------------------------
        Route::post('/thems/create','ColorsController@thems');
        Route::post('/thems/show','ColorsController@thems_show');
        Route::post('/thems/show/{thems}','ColorsController@thems_show1');
        Route::post('/thems/edit/{id}','ColorsController@thems_edit');
        Route::post('/thems/edit1/{form_id}','ColorsController@thems_edit1');
        Route::post('/thems/delete/{id}','ColorsController@thems_delete');
        //----------------------------------------end thems--------------------------------------------------------
        //---------------------------------------select thems----------------------------------
        Route::post('/selectthems/select2','ColorsController@select2');
        Route::post('/selectthems/create/{form_id}/{id}','ColorsController@select_thems');
        Route::post('/selectthems/show/{form_id}','ColorsController@show_select_thems');
        Route::post('/selectthems/edit/{form_id}','ColorsController@select_thems_edit');
        Route::post('/selectthems/delete/{id}','ColorsController@select_thems_delete');
        Route::post('/selectthems/delete/{form_id}','ColorsController@select_thems_delete1');
        //----------------------------------------end select thems--------------------------------------------------------
        /////------------------------------------add logo------------------------------------------------------
        Route::post('/logo','ElementformController@logo');
        Route::post('/logo_url','ElementformController@logo_with_url');
        Route::post('/logo/show/{form_id}','ElementformController@show_logo');
        Route::post('/logo/delete/{id}','ElementformController@delete_logo');
        Route::post('/logo/select/{id}/{form_id}','ElementformController@select_logo');
        Route::post('/logo/edit/{form_id}','ElementformController@select_logo_edit');
        Route::post('/logo/delete1/{id}','ElementformController@select_logo_delete');
        Route::post('/logo/delete2/{form_id}','ElementformController@select_logo_delete1');
        /////------------------------------------end logo------------------------------------------------------
        //---------------------------------------end form designer easy----------------------------------------
    });


});