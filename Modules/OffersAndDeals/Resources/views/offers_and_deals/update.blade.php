@extends('layouts.app')
@section('content')

              <!-- =============== Custom Content ===========-==========-->
              <div class="row">
                <div class="col-xs-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url( '../img/covers/dummy2.jpg ' )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
                    <div class="edit-mode">Editing mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">         
                          <div class="text-wraper">
                            <h3 class="cover-inside-title  ">العروض والاتفقيات</h3>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><span></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                    <form id="offers_edit">
                      <div class="row">
                        <div class="col-xs-6">
                          <div class="master_field">
                            <label class="master_label" for="offer_title">عنوان العرض</label>
                            <input class="master_input" type="text" maxlength="100" id="offer_title" name="offer_title"><span class="master_message inherit">message content</span>
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="master_field">
                            <label class="master_label" for="offer_description">وصف العرض</label>
                            <textarea class="master_input" name="offer_description" maxlength="255" id="offer_description"></textarea><span class="master_message color--fadegreen">validation message will be here</span>
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="master_field">
                            <label class="master_label mandatory" for="offer_category">فئة العرض</label>
                            <select class="master_input select2" id="offer_category" multiple="multiple" style="width:100%;" , name="offer_category">
                              <option>category1</option>
                              <option>category2</option>
                              <option>category3</option>
                            </select><span class="master_message inherit">message content</span>
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="master_field">
                            <label class="master_label" for="start_date">تاريخ البداية</label>
                            <div class="bootstrap-timepicker">
                              <input class="datepicker master_input" type="text" Required id="start_date" name="start_date">
                            </div><span class="master_message inherit">message content</span>
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="master_field">
                            <label class="master_label" for="end_date">تاريخ النهاية</label>
                            <div class="bootstrap-timepicker">
                              <input class="datepicker master_input" type="text" Required id="end_date" name="end_date">
                            </div><span class="master_message inherit">message content</span>
                          </div>
                        </div>
                        <div class="col-xs-6" style="text-align:end; padding-top: 2%;">
                          <div class="checkboxrobo">
                            <input type="checkbox" id="activation" name="activation">
                            <label for="activation">تفعيل</label>
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <label class="master_label mandatory">صورة العرض</label>
                          <div id="fileList"></div>
                          <div class="form-group" id="img_dr_btn" style="text-align:end;">
                            <input class="inputfile inputfile-1" id="file-1" type="file" name="file-1" onchange="updateList()">
                            <label for="file-1"><span>اختر صورة   </span></label>
                          </div>
                          <ul class="js-uploader__file-list uploader__file-list" id="img_dr_list" style="text-align:end;padding-left:9%;">
                            <li class="js-uploader__file-list uploader__file-list"><span class="uploader__file-list__button"></span><span class="uploader__file-list__button" id="delete"><a class="uploader__icon-button fa fa-times" id="close" onclick="closebtn1()"></a></span><span class="uploader__file-list__thumbnail"><img class="thumbnail" id="img_" src="../../img/avaters/male.jpg"></span></li>
                          </ul>
                        </div>
                      </div>
                    </form>
                    <div class="div" style="text-align:end;">
                      <button class="master-btn   undefined bgcolor--main  bshadow--0" type="submit"><i class="fa fa-save"></i><span>حفظ</span>
                      </button>
                      <button class="master-btn   undefined bgcolor--fadebrown  bshadow--0" type="submit"><i class="fa fa-close"></i><span>الغاء</span>
                      </button>
                    </div>
                  </div>
                </div><br>
              </div>
            
@endsection