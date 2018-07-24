@extends('layouts.app')
@section('content')

              <!-- =============== Custom Content ===========-==========-->
              <div class="row">
                <div class="col-xs-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url( '../img/covers/dummy2.jpg ' )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
                    <div class="add-mode">Adding mode</div>
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
                    <form id="offers_add">
                      <div class="row">
                        <div class="col-xs-6">
                          <div class="master_field">
                            <label class="master_label" for="offer_image">صورة العرض </label>
                            <div class="file-upload">
                              <div class="file-select">
                                <div class="file-select-name" id="noFile">اضغط لأضافة الصورة</div>
                                <input class="chooseFile" type="file" name="offer_image" id="offer_image">
                              </div>
                            </div><span class="master_message color--fadegreen">max 1MB</span>
                          </div>
                        </div>
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
                        <div class="col-xs-12" style="text-align:end;">
                          <div class="checkboxrobo">
                            <input type="checkbox" id="activation" name="activation">
                            <label for="activation">تفعيل</label>
                          </div>
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