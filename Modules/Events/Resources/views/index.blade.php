@extends('layouts.app')
@section('content')

              <!-- =============== Custom Content ===========-==========-->
              <div class="row">
                <div class="col-xs-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url( '../img/covers/dummy2.jpg ' )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">         
                          <div class="text-wraper">
                            <h3 class="cover-inside-title  ">Events</h3>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="bradius--no border-btn master-btn" type="button" href="events_backend_add.html">اضافة ايفينت جديد</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                    <div class="full-table">
                      <div class="filter__btns"><a class="filter-btn master-btn" href="#filter-users"><i class="fa fa-filter"></i>filters</a></div>
                      <div class="bottomActions__btns"><a class="master-btn #" href="#">مسح المحدد</a>
                      </div>
                      <div class="remodal" data-remodal-id="filter-users" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <div class="col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="filter_cat">فئات الايفينت</label>
                                <select class="master_input select2" id="filter_cat" multiple="multiple" style="width:100%;" ,>
                                  <option>Egypt</option>
                                  <option>KSA</option>
                                  <option>USA</option>
                                  <option>Sudan</option>
                                  <option>France</option>
                                  <option>Etc</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label">حالة الايفينت</label>
                                <div class="radiorobo">
                                  <input type="radio" id="event_status_2" name="activation">
                                  <label for="event_status_2">تفعيل</label>
                                </div>
                                <div class="radiorobo">
                                  <input type="radio" id="event_status_3" name="activation">
                                  <label for="event_status_3">عدم تفعيل</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="bootstrap_date_start_from">تاريخ البداية من</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" id="bootstrap_date_start_from">
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="bootstrap_date_start_to">تاريخ البداية الى</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" id="bootstrap_date_start_to">
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="bootstrap_date_End_from">تاريخ الانتهاء من</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" id="bootstrap_date_End_from">
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="bootstrap_date_End_to">تاريخ الانتهاء الى</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" id="bootstrap_date_End_to">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
                        <button class="remodal-confirm" data-remodal-action="confirm">تطبيق الفلتر</button>
                      </div>
                      <form id="dataTableTriggerId_001_form">
                        <table class="data-table-trigger table-master" id="dataTableTriggerId_001">
                          <thead>
                            <tr class="bgcolor--gray_mm color--gray_d">
                              <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                              <th><span class="cellcontent">رقم المسلسل</span></th>
                              <th><span class="cellcontent">اسم الايفينت</span></th>
                              <th><span class="cellcontent">المكان</span></th>
                              <th><span class="cellcontent">فئات الايفينت</span></th>
                              <th><span class="cellcontent">وقت بداية الايفينت</span></th>
                              <th><span class="cellcontent">وقت نهاية الايفينت</span></th>
                              <th><span class="cellcontent">تاريخ اضافة الايفينت</span></th>
                              <th><span class="cellcontent">تم اضافته من قبل</span></th>
                              <th><span class="cellcontent">حالة الايفينت</span></th>
                              <th><span class="cellcontent">الاجراءات</span></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent">Redbull flShar3</span></td>
                              <td><span class="cellcontent">CFC</span></td>
                              <td><span class="cellcontent">category</span></td>
                              <td><span class="cellcontent">15-7-2018 11:00am</span></td>
                              <td><span class="cellcontent">15-7-2018 7:00pm</span></td>
                              <td><span class="cellcontent">1-1-1975</span></td>
                              <td><span class="cellcontent">John Doe</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= events_backend_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= events_backend_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent">Redbull flShar3</span></td>
                              <td><span class="cellcontent">CFC</span></td>
                              <td><span class="cellcontent">category</span></td>
                              <td><span class="cellcontent">15-7-2018 11:00am</span></td>
                              <td><span class="cellcontent">15-7-2018 7:00pm</span></td>
                              <td><span class="cellcontent">1-1-1975</span></td>
                              <td><span class="cellcontent">John Doe</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= events_backend_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= events_backend_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent">Redbull flShar3</span></td>
                              <td><span class="cellcontent">CFC</span></td>
                              <td><span class="cellcontent">category</span></td>
                              <td><span class="cellcontent">15-7-2018 11:00am</span></td>
                              <td><span class="cellcontent">15-7-2018 7:00pm</span></td>
                              <td><span class="cellcontent">1-1-1975</span></td>
                              <td><span class="cellcontent">John Doe</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= events_backend_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= events_backend_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent">Redbull flShar3</span></td>
                              <td><span class="cellcontent">CFC</span></td>
                              <td><span class="cellcontent">category</span></td>
                              <td><span class="cellcontent">15-7-2018 11:00am</span></td>
                              <td><span class="cellcontent">15-7-2018 7:00pm</span></td>
                              <td><span class="cellcontent">1-1-1975</span></td>
                              <td><span class="cellcontent">John Doe</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= events_backend_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= events_backend_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent">Redbull flShar3</span></td>
                              <td><span class="cellcontent">CFC</span></td>
                              <td><span class="cellcontent">category</span></td>
                              <td><span class="cellcontent">15-7-2018 11:00am</span></td>
                              <td><span class="cellcontent">15-7-2018 7:00pm</span></td>
                              <td><span class="cellcontent">1-1-1975</span></td>
                              <td><span class="cellcontent">John Doe</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= events_backend_view.html ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= events_backend_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                          </tbody>
                        </table>
                      </form>
                      <div class="remodal log-custom" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <h2 class="title">title of the changing log in</h2>
                          <div class="log-content">
                            <div class="log-container">
                              <table class="log-table">
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <th>log title</th>
                                  <th>user</th>
                                  <th>time</th>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>January</td>
                                  <td>$100</td>
                                  <td>$100</td>
                                </tr>
                                <tr class="log-row" data-link="https://www.google.com.eg/">
                                  <td>February</td>
                                  <td>$80</td>
                                  <td>$80</td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><br>
              </div>
            
@endsection