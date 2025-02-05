/*!
 *  Lang.js for Laravel localization in JavaScript.
 *
 *  @version 1.1.10
 *  @license MIT https://github.com/rmariuzzo/Lang.js/blob/master/LICENSE
 *  @site    https://github.com/rmariuzzo/Lang.js
 *  @author  Rubens Mariuzzo <rubens@mariuzzo.com>
 */
(function(root,factory){"use strict";if(typeof define==="function"&&define.amd){define([],factory)}else if(typeof exports==="object"){module.exports=factory()}else{root.Lang=factory()}})(this,function(){"use strict";function inferLocale(){if(typeof document!=="undefined"&&document.documentElement){return document.documentElement.lang}}function convertNumber(str){if(str==="-Inf"){return-Infinity}else if(str==="+Inf"||str==="Inf"||str==="*"){return Infinity}return parseInt(str,10)}var intervalRegexp=/^({\s*(\-?\d+(\.\d+)?[\s*,\s*\-?\d+(\.\d+)?]*)\s*})|([\[\]])\s*(-Inf|\*|\-?\d+(\.\d+)?)\s*,\s*(\+?Inf|\*|\-?\d+(\.\d+)?)\s*([\[\]])$/;var anyIntervalRegexp=/({\s*(\-?\d+(\.\d+)?[\s*,\s*\-?\d+(\.\d+)?]*)\s*})|([\[\]])\s*(-Inf|\*|\-?\d+(\.\d+)?)\s*,\s*(\+?Inf|\*|\-?\d+(\.\d+)?)\s*([\[\]])/;var defaults={locale:"en"};var Lang=function(options){options=options||{};this.locale=options.locale||inferLocale()||defaults.locale;this.fallback=options.fallback;this.messages=options.messages};Lang.prototype.setMessages=function(messages){this.messages=messages};Lang.prototype.getLocale=function(){return this.locale||this.fallback};Lang.prototype.setLocale=function(locale){this.locale=locale};Lang.prototype.getFallback=function(){return this.fallback};Lang.prototype.setFallback=function(fallback){this.fallback=fallback};Lang.prototype.has=function(key,locale){if(typeof key!=="string"||!this.messages){return false}return this._getMessage(key,locale)!==null};Lang.prototype.get=function(key,replacements,locale){if(!this.has(key,locale)){return key}var message=this._getMessage(key,locale);if(message===null){return key}if(replacements){message=this._applyReplacements(message,replacements)}return message};Lang.prototype.trans=function(key,replacements){return this.get(key,replacements)};Lang.prototype.choice=function(key,number,replacements,locale){replacements=typeof replacements!=="undefined"?replacements:{};replacements.count=number;var message=this.get(key,replacements,locale);if(message===null||message===undefined){return message}var messageParts=message.split("|");var explicitRules=[];for(var i=0;i<messageParts.length;i++){messageParts[i]=messageParts[i].trim();if(anyIntervalRegexp.test(messageParts[i])){var messageSpaceSplit=messageParts[i].split(/\s/);explicitRules.push(messageSpaceSplit.shift());messageParts[i]=messageSpaceSplit.join(" ")}}if(messageParts.length===1){return message}for(var j=0;j<explicitRules.length;j++){if(this._testInterval(number,explicitRules[j])){return messageParts[j]}}var pluralForm=this._getPluralForm(number);return messageParts[pluralForm]};Lang.prototype.transChoice=function(key,count,replacements){return this.choice(key,count,replacements)};Lang.prototype._parseKey=function(key,locale){if(typeof key!=="string"||typeof locale!=="string"){return null}var segments=key.split(".");var source=segments[0].replace(/\//g,".");return{source:locale+"."+source,sourceFallback:this.getFallback()+"."+source,entries:segments.slice(1)}};Lang.prototype._getMessage=function(key,locale){locale=locale||this.getLocale();key=this._parseKey(key,locale);if(this.messages[key.source]===undefined&&this.messages[key.sourceFallback]===undefined){return null}var message=this.messages[key.source];var entries=key.entries.slice();var subKey="";while(entries.length&&message!==undefined){var subKey=!subKey?entries.shift():subKey.concat(".",entries.shift());if(message[subKey]!==undefined){message=message[subKey];subKey=""}}if(typeof message!=="string"&&this.messages[key.sourceFallback]){message=this.messages[key.sourceFallback];entries=key.entries.slice();subKey="";while(entries.length&&message!==undefined){var subKey=!subKey?entries.shift():subKey.concat(".",entries.shift());if(message[subKey]){message=message[subKey];subKey=""}}}if(typeof message!=="string"){return null}return message};Lang.prototype._findMessageInTree=function(pathSegments,tree){while(pathSegments.length&&tree!==undefined){var dottedKey=pathSegments.join(".");if(tree[dottedKey]){tree=tree[dottedKey];break}tree=tree[pathSegments.shift()]}return tree};Lang.prototype._applyReplacements=function(message,replacements){for(var replace in replacements){message=message.replace(new RegExp(":"+replace,"gi"),function(match){var value=replacements[replace];var allCaps=match===match.toUpperCase();if(allCaps){return value.toUpperCase()}var firstCap=match===match.replace(/\w/i,function(letter){return letter.toUpperCase()});if(firstCap){return value.charAt(0).toUpperCase()+value.slice(1)}return value})}return message};Lang.prototype._testInterval=function(count,interval){if(typeof interval!=="string"){throw"Invalid interval: should be a string."}interval=interval.trim();var matches=interval.match(intervalRegexp);if(!matches){throw"Invalid interval: "+interval}if(matches[2]){var items=matches[2].split(",");for(var i=0;i<items.length;i++){if(parseInt(items[i],10)===count){return true}}}else{matches=matches.filter(function(match){return!!match});var leftDelimiter=matches[1];var leftNumber=convertNumber(matches[2]);if(leftNumber===Infinity){leftNumber=-Infinity}var rightNumber=convertNumber(matches[3]);var rightDelimiter=matches[4];return(leftDelimiter==="["?count>=leftNumber:count>leftNumber)&&(rightDelimiter==="]"?count<=rightNumber:count<rightNumber)}return false};Lang.prototype._getPluralForm=function(count){switch(this.locale){case"az":case"bo":case"dz":case"id":case"ja":case"jv":case"ka":case"km":case"kn":case"ko":case"ms":case"th":case"tr":case"vi":case"zh":return 0;case"af":case"bn":case"bg":case"ca":case"da":case"de":case"el":case"en":case"eo":case"es":case"et":case"eu":case"fa":case"fi":case"fo":case"fur":case"fy":case"gl":case"gu":case"ha":case"he":case"hu":case"is":case"it":case"ku":case"lb":case"ml":case"mn":case"mr":case"nah":case"nb":case"ne":case"nl":case"nn":case"no":case"om":case"or":case"pa":case"pap":case"ps":case"pt":case"so":case"sq":case"sv":case"sw":case"ta":case"te":case"tk":case"ur":case"zu":return count==1?0:1;case"am":case"bh":case"fil":case"fr":case"gun":case"hi":case"hy":case"ln":case"mg":case"nso":case"xbr":case"ti":case"wa":return count===0||count===1?0:1;case"be":case"bs":case"hr":case"ru":case"sr":case"uk":return count%10==1&&count%100!=11?0:count%10>=2&&count%10<=4&&(count%100<10||count%100>=20)?1:2;case"cs":case"sk":return count==1?0:count>=2&&count<=4?1:2;case"ga":return count==1?0:count==2?1:2;case"lt":return count%10==1&&count%100!=11?0:count%10>=2&&(count%100<10||count%100>=20)?1:2;case"sl":return count%100==1?0:count%100==2?1:count%100==3||count%100==4?2:3;case"mk":return count%10==1?0:1;case"mt":return count==1?0:count===0||count%100>1&&count%100<11?1:count%100>10&&count%100<20?2:3;case"lv":return count===0?0:count%10==1&&count%100!=11?1:2;case"pl":return count==1?0:count%10>=2&&count%10<=4&&(count%100<12||count%100>14)?1:2;case"cy":return count==1?0:count==2?1:count==8||count==11?2:3;case"ro":return count==1?0:count===0||count%100>0&&count%100<20?1:2;case"ar":return count===0?0:count==1?1:count==2?2:count%100>=3&&count%100<=10?3:count%100>=11&&count%100<=99?4:5;default:return 0}};return Lang});

(function () {
    Lang = new Lang();
    Lang.setMessages({"en.auth":{"e-mail":"E-mail","failed":"These credentials do not match our records.","login_to_continue":"Login to continue","password":"Password","please_enter_a_valid_email":"Please enter a valid E-mail.","remember_me":"Remember Me","sign_in":"Sign In","throttle":"Too many login attempts. Please try again in :seconds seconds."},"en.countries":{"Myanmar":"Myanmar","Norway":"Norway","Sweden":"Sweden"},"en.country":{"country":"Country","country_code":"Country code"},"en.customercases":{"add_customer_case":"Add customer case","case_description":"Case description","case_id":"Case ID","customer_case":"Customer case","customer_case_added":"Customer case added","customer_case_deleted":"Customer case deleted","customer_case_deletion_failed":"Customer case deletion failed","customer_case_details":"Customer case details","customer_case_has_been_updated":"Customer case has been updated","customer_case_information":"Customer case information","customer_case_list":"Customer case list","customer_cases":"Customer cases","editing_customer_case":"Editing customer case","new_customer_case":"New customer case","please_fill_out_the_sms_textarea_to_send_a_message":"Please fill out the SMS textarea to send a SMS to the customer","status_updated":"Status updated","the_sms_field_can_be_no_longer_than_160_characters":"The SMS field can be no longer than 160 characters","the_sms_field_requires_at_least_6_characters":"The SMS field requires at least 6 characters","update_status":"Update status","update_status_text":"You are currently updating the status of <strong>:customercase_name<\/strong> from <strong class=\"text-:from_color\">:from_name<\/strong> to <strong class=\"text-:to_color\">:to_name<\/strong>. If you wish to send an SMS please fill out the text area below."},"en.customers":{"add_customer":"Add customer","customer":"Customer","customer_added":"Customer added","customer_deleted":"Customer deleted","customer_deletion_failed":"Customer deletion failed","customer_details":"Customer details","customer_has_been_updated":"Customer has been updated","customer_information":"Customer information","customer_list":"Customer list","customers":"Customers","edit_customer":"Edit customer","send_sms":"Send SMS","send_sms_to_customer":"Send SMS to customer"},"en.dashboard":{"customercases_with_processed_status":"Cases with processed status","customercases_with_received_status":"Cases with received status","customercases_with_resolved_status":"Cases with resolved status","customercases_with_under_processing_status":"Cases with under processing status","dashboard":"Dashboard"},"en.datatable":{"displaying_records":"Displaying :start - :end of :total records","first":"First","last":"Last","more_pages":"More pages","next":"Next","no_records_found":"No records found","page_number":"Page number","please_wait":{"":{"":{"":"Please wait..."}}},"previous":"Previous","select_page_size":"Select page size"},"en.errors":{"maintenance":"Maintenance","not_found":"Not Found","not_found_description":"This page does not exist<br \/>or has never existed.","not_found_description_type":"This :type does not exist<br \/>or has never existed.","please_try_again_in_5_minutes":"Please try again in 5 minutes.","type_customercase":"customercase","we_are_currently_uploading_the_newest_updates":"We are currently uploading the newest updates."},"en.form":{"this_field_is_required":"This field is required."},"en.layout":{"actions":"Actions","address":"Address","administrator_tools":"Administrator Tools","all":"All","are_you_sure_you_want_to_continue":"Are you sure you want to continue","assigned":"Assigned","by":"by","cancel":"Cancel","change_password":"Change Password","city":"City","close":"Close","completed":"Completed","configuration":"Configuration","confirmation":"Confirmation","continue":"Continue","created_at":"Created at","created_by":"Created by","date":"Date","delete":"Delete","description":"Description","edit":"Edit","edit_profile":"Edit Profile","email":"Email","error":"Error","general":"General","logout":"Logout","message":"Message","my_profile":"My Profile","name":"Name","navigation":"Navigation","new_template":"New template","no_template_found":"No template was found","none":"None","of":"of","phone_number":"Phone number","please_write_your_sms_message_here":"Please write your SMS message here","postal_code":"Postal code","processed":"Processed","received":"Received","required_info_text":"Fields marked with <required>*<\/required> are mandatory.","resolved":"Resolved","save":"Save","search":{"":{"":{"":"Search..."}}},"select":"Select","send":"Send","send_sms":"Send SMS","settings":"Settings","sms":"SMS","status":"Status","success":"Success","title":"Title","under_processing":"Under processing","unknown":"Unknown","update":"Update","version":"Version","view":"View","welcome":"Welcome","your_sms_was_sent":"Your SMS was sent"},"en.menu":{"Country":"Country","Customer Cases":"Customer Cases","Customers":"Customers","Dashboard":"Dashboard","Inventory":"Inventory","Master Setup":"Master Setup","Modules Permissions":"Modules Permissions","Organizations":"Organizations","Roles":"Roles","Users":"Users"},"en.organizations":{"add_organization":"Add organization","edit_organization":"Edit organization","new_organization":"New organization","no_organization_found":"No organization found","organization":"Organization","organization_deleted":"Organization deleted","organization_has_been_added":"Organization has been added","organization_information":"Organization information","organization_list":"Organization list","organization_name":"Organization name","organization_number":"Org. number","organization_settings":"Organization settings","organization_updated":"Organization updated","organization_users":"Organization users","organizations":"Organizations","vat_number":"VAT number"},"en.pagination":{"next":"Next &raquo;","previous":"&laquo; Previous"},"en.passwords":{"password":"Passwords must be at least six characters and match the confirmation.","reset":"Your password has been reset!","sent":"We have e-mailed your password reset link!","token":"This password reset token is invalid.","user":"We can't find a user with that e-mail address."},"en.roles":{"create_new_role":"Create new role","create_role":"Create role","delete_role":"Delete role","edit_role":"Edit role","organization_admin":"Administrator","permissions":"Permissions","role":"Role","role_deleted":"Role deleted","role_deletion_failed":"Role deletion failed","role_has_been_created":"Role has been created","role_name":"Role name","role_permissions_updated":"Role permissions updated","roles":"Roles","update_role_permissions":"Update role permissions","user_role_management":"User role management"},"en.settings":{"case_opened":"Case opened","case_opened_help":"Standard SMS template that is used when a new case is opened.","case_processed":"Case processed","case_processed_help":"Standard SMS template that is used when the status of a case is changed to \"Processed\".","case_resolved":"Case resolved","case_resolved_help":"Standard SMS template that is used when the status of a case is changed to \"Resolved\".","case_under_processing":"Case under processing","case_under_processing_help":"Standard SMS template that is used when the status of a case is changed to \"Under processing\".","customer_case_sms_templates":"Customer case SMS templates","default_sms":"Default SMS","default_sms_help":"Standard SMS template used when sending an SMS.","edit_template":"Edit template","general_settings":"General settings","new_template":"New template","organization_settings":"Organization settings","settings":"Settings","settings_were_updated":"Instillingene ble oppdatert","sms_settings":"SMS settings","sms_templates":"SMS templates","template_added":"Template added","template_deleted":"Template deleted","template_deletion_failed":"Template deletion failed","template_details":"Template details","template_information":"Template information","template_updated":"Template updated"},"en.strings":{"\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/ For Role module \/\/\/\/\/\/\/\/\/":"","\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/For Organization Module\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/":"","\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/For common text\/\/\/\/\/\/\/\/\/\/\/":"","\/\/\/\/\/\/\/\/\/\/\/\/\/\/For Module module\/\/\/\/\/\/\/\/\/\/":"","\/\/\/\/\/\/\/\/\/\/\/For user module\/\/\/\/\/\/\/\/\/\/\/":"","\/\/\/\/\/\/\/For country Module\/\/\/\/\/\/":"","Actions":"Actions","Add Country":"Add Country","Add Customer":"Add Customer","Add New Customer":"Add New Customer","Add New Role":"Add New Role","Add New User":"Add New User","Add Organization":"Add Organization","Add Role":"Add Role","Add User":"Add User","Address":"Address","Cancel":"Cancel","Change Password":"Change Password","Code":"Code","Confirm Password":"Confirm Password","Country":"Country","Country Added Successfully!":"Country Added Successfully!","Country Addition":"Country Addition","Country Code":"Country Code","Country Deleted":"Country Deleted","Country Deletetion Failed":"Country Deletetion Failed","Country List":"Country List","Country Name":"Country Name","Country Update":"Country Update","Country Updated Successfully!":"Country Updated Successfully!","Customer Added Successfully!":"Customer Added Successfully!","Customer Deleted":"Customer Deleted","Customer Deletetion Failed":"Customer Deletetion Failed","Customer Information":"Customer Information","Customer Name":"Customer Name","Customer Update":"Customer Update","Customers List":"Customers List","Delete":"Delete","Delete Role":"Delete Role","Edit":"Edit","Edit Profile":"Edit Profile","Edit Role":"Edit Role","Email":"Email","Employee Information":"Employee Information","Employee Name":"Employee Name","Error!!!":"Error!!!","Max Digits":"Max Digits","Min Digits":"Min Digits","Minimum No. Digits":"Minimum No. Digits","Module Permission Updated Successfully!":"Module Permission Updated Successfully!","Module Permissions":"Module Permissions","My Profile":"My Profile","Name":"Name","New Password":"New Password","Organization Added Successfully!":"Organization Added Successfully!","Organization Addition":"Organization Addition","Organization Deleted":"Organization Deleted","Organization Deletetion Failed":"Organization Deletetion Failed","Organization Hierarchy":"Organization Hierarchy","Organization Information":"Organization Information","Organization Module permissions":"Organization Module permissions","Organization Name":"Organization Name","Organization No.":"Organization No.","Organization Update":"Organization Update","Organization Updated Successfully!":"Organization Updated Successfully!","Organization Users":"Organization Users","Organizations List":"Organizations List","Password":"Password","Password Changed Successfully!":"Password Changed Successfully!","Phone No":"Phone No","Postal Code":"Postal Code","Profile Updated Successfully!":"Profile Updated Successfully!","Role":"Role","Role Addded Successfully!":"Role Addded Successfully!","Role Deleted":"Role Deleted","Role Deletetion Failed.May be associated with users":"Role Deletetion Failed.May be associated with users","Role Edited Successfully!":"Role Edited Successfully!","Role Name":"Role Name","Role Permission Updated Successfully!":"Role Permission Updated Successfully!","Role Permissions":"Role Permissions","Save":"Save","Select":"Select","Send Sms":"Send Sms","Success!!!":"Success!!!","Updated Successfully!":"Updated Successfully!","User Addded Successfully!":"User Addded Successfully!","User Deleted":"User Deleted","User Deletetion Failed":"User Deletetion Failed","User List":"User List","User Name":"User Name","User Role Management":"User Role Management","User Update":"User Update","User Updated Successfully!":"User Updated Successfully!","Users List":"Users List","Vat Number":"Vat Number","View":"View","error":"error","permission denied":"permission denied","update Module Permission":"update Module Permission","update Role Permission":"update Role Permission"},"en.users":{"add_new_user":"Add new user","add_user":"Add user","change_password":"Change password","confirm_password":"Confirm password","country":"Country","e-mail":"E-mail","edit_profile":"Edit profile","edit_user":"Edit user","full_name":"Full name","my_profile":"My profile","name":"Name","new_password":"New password","only_change_this_if_you_want_to_change_the_users_password":"Only change this if you want to edit the users password.","password_has_been_changed":"Password has been changed","phone_number":"Phone number","profile_has_been_updated":"Profile has been updated","role":"Role","user":"User","user_deleted":"User deleted","user_deletion_failed":"User deletion failed","user_has_been_created":"User has been created","user_list":"User List","user_was_updated":"User was updated","users":"Users"},"en.validation":{"accepted":"The :attribute must be accepted.","active_url":"The :attribute is not a valid URL.","after":"The :attribute must be a date after :date.","after_or_equal":"The :attribute must be a date after or equal to :date.","alpha":"The :attribute may only contain letters.","alpha_dash":"The :attribute may only contain letters, numbers, dashes and underscores.","alpha_num":"The :attribute may only contain letters and numbers.","array":"The :attribute must be an array.","before":"The :attribute must be a date before :date.","before_or_equal":"The :attribute must be a date before or equal to :date.","between":{"array":"The :attribute must have between :min and :max items.","file":"The :attribute must be between :min and :max kilobytes.","numeric":"The :attribute must be between :min and :max.","string":"The :attribute must be between :min and :max characters."},"boolean":"The :attribute field must be true or false.","confirmed":"The :attribute confirmation does not match.","custom":{"address":{"required":"You need to fill in the adress field."},"attribute-name":{"rule-name":"custom-message"},"country_id":{"required":"You need to select a country."},"email":{"required":"The email field is required."},"name":{"required":"The name field is required."},"password":{"required":"The password field is required."},"phone_code":{"required":"Please select a country to fetch the country code."},"phone_no":{"required":"You need to fill out a valid phone number."},"postal_code":{"required":"You need to fill out the postal code."},"role_id":{"required":"You need to specify a role for the user."}},"date":"The :attribute is not a valid date.","date_format":"The :attribute does not match the format :format.","different":"The :attribute and :other must be different.","digits":"The :attribute must be :digits digits.","digits_between":"The :attribute must be between :min and :max digits.","dimensions":"The :attribute has invalid image dimensions.","distinct":"The :attribute field has a duplicate value.","email":"The :attribute must be a valid email address.","exists":"The selected :attribute is invalid.","file":"The :attribute must be a file.","filled":"The :attribute field must have a value.","gt":{"array":"The :attribute must have more than :value items.","file":"The :attribute must be greater than :value kilobytes.","numeric":"The :attribute must be greater than :value.","string":"The :attribute must be greater than :value characters."},"gte":{"array":"The :attribute must have :value items or more.","file":"The :attribute must be greater than or equal :value kilobytes.","numeric":"The :attribute must be greater than or equal :value.","string":"The :attribute must be greater than or equal :value characters."},"image":"The :attribute must be an image.","in":"The selected :attribute is invalid.","in_array":"The :attribute field does not exist in :other.","integer":"The :attribute must be an integer.","ip":"The :attribute must be a valid IP address.","ipv4":"The :attribute must be a valid IPv4 address.","ipv6":"The :attribute must be a valid IPv6 address.","json":"The :attribute must be a valid JSON string.","lt":{"array":"The :attribute must have less than :value items.","file":"The :attribute must be less than :value kilobytes.","numeric":"The :attribute must be less than :value.","string":"The :attribute must be less than :value characters."},"lte":{"array":"The :attribute must not have more than :value items.","file":"The :attribute must be less than or equal :value kilobytes.","numeric":"The :attribute must be less than or equal :value.","string":"The :attribute must be less than or equal :value characters."},"max":{"array":"The :attribute may not have more than :max items.","file":"The :attribute may not be greater than :max kilobytes.","numeric":"The :attribute may not be greater than :max.","string":"The :attribute may not be greater than :max characters."},"mimes":"The :attribute must be a file of type: :values.","mimetypes":"The :attribute must be a file of type: :values.","min":{"array":"The :attribute must have at least :min items.","file":"The :attribute must be at least :min kilobytes.","numeric":"The :attribute must be at least :min.","string":"The :attribute must be at least :min characters."},"not_in":"The selected :attribute is invalid.","not_regex":"The :attribute format is invalid.","numeric":"The :attribute must be a number.","present":"The :attribute field must be present.","regex":"The :attribute format is invalid.","required":"The :attribute field is required.","required_if":"The :attribute field is required when :other is :value.","required_unless":"The :attribute field is required unless :other is in :values.","required_with":"The :attribute field is required when :values is present.","required_with_all":"The :attribute field is required when :values are present.","required_without":"The :attribute field is required when :values is not present.","required_without_all":"The :attribute field is required when none of :values are present.","same":"The :attribute and :other must match.","size":{"array":"The :attribute must contain :size items.","file":"The :attribute must be :size kilobytes.","numeric":"The :attribute must be :size.","string":"The :attribute must be :size characters."},"string":"The :attribute must be a string.","timezone":"The :attribute must be a valid zone.","unique":"The :attribute has already been taken.","uploaded":"The :attribute failed to upload.","url":"The :attribute format is invalid.","uuid":"The :attribute must be a valid UUID."},"no.auth":{"e-mail":"E-Mail","failed":"Brukernavnet eller passordet er ikke korrekt.","login_to_continue":"Logg inn for \u00e5 fortsette","password":"Passord","please_enter_a_valid_email":"Vennligst skriv inn en gyldig E-mail.","remember_me":"Husk Meg","sign_in":"Logg inn","throttle":"For mange fors\u00f8k p\u00e5 \u00e5 logge inn med feil p\u00e5logingsdetaljer. Vennlgist pr\u00f8v igjen om :seconds sekunder."},"no.countries":{"Myanmar":"Myanmar","Norway":"Norge","Sweden":"Sverige"},"no.country":{"country":"Land","country_code":"Landskode"},"no.customercases":{"add_customer_case":"Ny kundesak","case_description":"Sak beskrivelse","case_id":"Sak ID","customer_case":"Kunde sak","customer_case_added":"Kundesak lagt til","customer_case_deleted":"Kunde sak slettet","customer_case_deletion_failed":"En feil oppstod ved sletting av kunde sak","customer_case_details":"Kundesak detaljer","customer_case_has_been_updated":"Kundesaken ble oppdatert","customer_case_information":"Kundesak informasjon","customer_case_list":"Kundesak liste","customer_cases":"Kunde saker","editing_customer_case":"Endring av kundesak","new_customer_case":"Ny kundesak","please_fill_out_the_sms_textarea_to_send_a_message":"Vennligst fyll ut SMS text feltet for \u00e5 sende en SMS til kunden","status_updated":"Status oppdatert","the_sms_field_can_be_no_longer_than_160_characters":"SMS feltet kan ikke inneholde mer enn 160 tegn","the_sms_field_requires_at_least_6_characters":"SMS feltet m\u00e5 minst inneholde 6 tegn","update_status":"Oppdater status","update_status_text":"Du oppdaterer n\u00e5 statusen p\u00e5 <strong>:customercase_name<\/strong> fra <strong class=\"text-:from_color\">:from_name<\/strong> til <strong class=\"text-:to_color\">:to_name<\/strong>. Om du \u00f8nsker \u00e5 sende en SMS vennligst fyll ut feltet under."},"no.customers":{"add_customer":"Ny kunde","customer":"Kunde","customer_added":"Kunden ble lagt til","customer_deleted":"Kunden ble slettet","customer_deletion_failed":"Feil ved sletting av kunden","customer_details":"Kunde detaljer","customer_has_been_updated":"Kunden ble oppdatert","customer_information":"Kundeinformasjon","customer_list":"Kunde liste","customers":"Kunder","edit_customer":"Endre kunde","send_sms":"Send SMS","send_sms_to_customer":"Send SMS til kunde"},"no.dashboard":{"customercases_with_processed_status":"Saker med behandlet status","customercases_with_received_status":"Saker med mottatt status","customercases_with_resolved_status":"Saker med l\u00f8st status","customercases_with_under_processing_status":"Saker med under behandling status","dashboard":"Instrumentpanel"},"no.datatable":{"displaying_records":"Viser :start - :end av :total oppf\u00f8ringer","first":"F\u00f8rste","last":"Siste","more_pages":"Flere sider","next":"Neste","no_records_found":"Ingen oppf\u00f8ringer funnet","page_number":"Side nummer","please_wait":{"":{"":{"":"Vennligst vent..."}}},"previous":"Forrige","select_page_size":"Velg st\u00f8rrelse p\u00e5 side"},"no.errors":{"maintenance":"Vedlikehold","not_found":"Ikke Funnet","not_found_description":"Denne siden eksisterer ikke<br \/>eller har aldri eksistert.","not_found_description_type":"Denne :type eksisterer ikke<br \/>eller har aldri eksistert.","please_try_again_in_5_minutes":"Vennligst pr\u00f8v igjen om 5 minutter.","type_customercase":"kundesaken","we_are_currently_uploading_the_newest_updates":"Vi laster for \u00f8yeblikket opp de nyeste oppdateringene."},"no.form":{"this_field_is_required":"Dette feltet er obligatorisk."},"no.layout":{"actions":"Valg","address":"Adresse","administrator_tools":"Administrator Verkt\u00f8y","all":"Alle","are_you_sure_you_want_to_continue":"Er du sikker p\u00e5 at du vil fortsette","assigned":"Tildelt","by":"av","cancel":"Avbryt","change_password":"Endre passord","city":"By \/ Poststed","close":"Lukk","completed":"Fullf\u00f8rt","configuration":"Konfigurasjon","confirmation":"Bekreftelse","continue":"Fortsett","created_at":"Opprettet","created_by":"Opprettet av","date":"Dato","delete":"Slett","description":"Beskrivelse","edit":"Endre","edit_profile":"Endre profil","email":"Email","error":"Feilmelding","general":"Generelle","logout":"Logg ut","message":"Melding","my_profile":"Min Profil","name":"Navn","navigation":"Navigasjon","new_template":"Ny mal","no_template_found":"Finner ingen mal","none":"Ingen","of":"av","phone_number":"Telefon nummer","please_write_your_sms_message_here":"Vennligst fyll ut SMS meldingen her","postal_code":"Postnummer","processed":"Behandlet","received":"Mottatt","required_info_text":"Felt markert med <required>*<\/required> er obligatoriske.","resolved":"L\u00f8st","save":"Lagre","search":{"":{"":{"":"S\u00f8k..."}}},"select":"Velg","send":"Send","send_sms":"Send SMS","settings":"Innstillinger","sms":"SMS","status":"Status","success":"Supert","title":"Tittel","under_processing":"Under behandling","unknown":"Ukjent","update":"Oppdater","version":"Versjon","view":"Vis","welcome":"Velkommen","your_sms_was_sent":"Din sms ble sendt"},"no.menu":{"Country":"Land","Customer Cases":"Kunde Saker","Customers":"Kunder","Dashboard":"Instrumentpanel","Inventory":"Inventar","Master Setup":"Oppsett","Modules Permissions":"Modul Tillatelser","Organizations":"Organisasjoner","Roles":"Roller","Users":"Brukere"},"no.organizations":{"add_organization":"Ny organisasjon","edit_organization":"Endre organisasjon","new_organization":"Ny organisasjon","no_organization_found":"Ingen organisasjon funnet","organization":"Organisasjon","organization_deleted":"Organisasjon ble slettet","organization_has_been_added":"Organisasjonen ble lagt til","organization_information":"Organisasjon informasjon","organization_list":"Organisasjon liste","organization_name":"Organisasjon navn","organization_number":"Org. nummer","organization_settings":"Organisasjons-innstillinger","organization_updated":"Organisasjon oppdatert","organization_users":"Organisasjon brukere","organizations":"Organisasjoner","vat_number":"Org. nummer"},"no.roles":{"create_new_role":"Opprett en ny rolle","create_role":"Opprett rolle","delete_role":"Slett rolle","edit_role":"Endre rolle","organization_admin":"Administrator","permissions":"Tillatelser","role":"Rolle","role_deleted":"Rolle slettet","role_deletion_failed":"Feil ved sletting av rolle","role_has_been_created":"Rollen ble opprettet","role_name":"Rolle navn","role_permissions_updated":"Rolle tillatelser oppdatert","roles":"Roller","update_role_permissions":"Oppdater rolle tillatelser","user_role_management":"Bruker rolle administrasjon"},"no.settings":{"case_opened":"Sak \u00e5pnet","case_opened_help":"Standard SMS mal som blir brukt n\u00e5r en sak \u00e5pnes.","case_processed":"Sak behandlet","case_processed_help":"Standard SMS mal som blir brukt n\u00e5r statuen p\u00e5 en sak blir endret til \"Behandlet\".","case_resolved":"Sak l\u00f8st","case_resolved_help":"Standard SMS mal som blir brukt n\u00e5r statuen p\u00e5 en sak blir endret til \"L\u00f8st\".","case_under_processing":"Sak under behandling","case_under_processing_help":"Standard SMS mal som blir brukt n\u00e5r statuen p\u00e5 en sak blir endret til \"Under behandling\".","customer_case_sms_templates":"Kundesak SMS maler","default_sms":"Standard SMS","default_sms_help":"Standard SMS mal som blir brukt n\u00e5r du sender en SMS.","edit_template":"Endre mal","general_settings":"Generelle innstillinger","new_template":"Ny mal","organization_settings":"Organisasjons-innstillinger","settings":"Innstillinger","settings_were_updated":"Innstillingene ble lagret","sms_settings":"SMS innstillinger","sms_templates":"SMS maler","template_added":"Mal opprettet","template_deleted":"Malen ble slettet","template_deletion_failed":"Det oppstod en feil ved sletting av malen","template_details":"Mal detaljer","template_information":"Mal informasjon","template_updated":"Mal oppdatert"},"no.users":{"add_new_user":"Opprett en ny bruker","add_user":"Ny bruker","change_password":"Endre passord","confirm_password":"Gjenta passord","country":"Land","e-mail":"E-mail","edit_profile":"Endre profil","edit_user":"Rediger bruker","full_name":"Fullt Navn","my_profile":"Min profil","name":"Navn","new_password":"Nytt passord","only_change_this_if_you_want_to_change_the_users_password":"Endre dette kun om du \u00f8nsker \u00e5 endre brukerens passord.","password_has_been_changed":"Passordet ble endret","phone_number":"Telefonnummer","profile_has_been_updated":"Profilen din ble oppdatert","role":"Rolle","user":"Bruker","user_deleted":"Bruker slettet","user_deletion_failed":"Feil ved sletting av bruker","user_has_been_created":"Brukeren ble opprettet","user_list":"Bruker liste","user_was_updated":"Brukeren ble oppdatert","users":"Brukere"},"no.validation":{"accepted":":attribute m\u00e5 v\u00e6re akseptert.","active_url":":attribute er ikke en gyldig URL.","after":":attribute m\u00e5 v\u00e6re en dato etter :date.","after_or_equal":":attribute m\u00e5 v\u00e6re en dato etter eller den samme som :date.","alpha":":attribute kan kun inneholde bokstaver.","alpha_dash":":attribute kan kun inneholde bokstaver, nummer, bindestrek eller understrek.","alpha_num":":attribute kan kun inneholde bokstaver og nummer.","array":":attribute m\u00e5 v\u00e6re en liste.","before":":attribute m\u00e5 v\u00e6re en dato f\u00f8r :date.","before_or_equal":":attribute m\u00e5 v\u00e6re en dato f\u00f8r eller den samme som :date.","between":{"array":":attribute m\u00e5 v\u00e6re mellom :min og :max elementer.","file":":attribute m\u00e5 v\u00e6re mellom :min og :max kilobytes.","numeric":":attribute m\u00e5 v\u00e6re mellom :min og :max tegn.","string":":attribute m\u00e5 best\u00e5 av mellom :min og :max tegn."},"boolean":":attribute m\u00e5 v\u00e6re ja eller nei.","custom":{"address":{"required":"Adresse feltet er obligatorisk."},"country_id":{"required":"Det er obligatorisk \u00e5 velge ett land."},"email":{"required":"Email feltet er obligatorisk."},"name":{"required":"Navn feltet er obligatorisk."},"password":{"required":"Passord feltet er obligatorisk."},"phone_code":{"required":"Vennligst velg ett land for \u00e5 oppdatere landskoden."},"phone_no":{"required":"Vennligst fyll ut ett gyldig telefonnummer."},"postal_code":{"required":"Postnummer feltet er obligatorisk."},"role_id":{"required":"Vennligst velg en rolle for brukeren."}},"date":":attribute er ikke en gyldig dato.","required":":attribute feltet er obligatorisk."}});
})();
