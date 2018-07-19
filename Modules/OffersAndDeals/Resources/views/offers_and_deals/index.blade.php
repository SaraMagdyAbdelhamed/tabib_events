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
                            <h3 class="cover-inside-title  ">العروض والاتفقيات</h3>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="bradius--no border-btn master-btn" type="button" href="offers_and_deals_add.html"> اضافة عروض واتفقيات جديدة</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                    <div class="full-table">
                      <div class="bottomActions__btns"><a class="master-btn #" href="#">حذف المحدد</a>
                      </div>
                      <form id="dataTableTriggerId_001_form">
                        <table class="data-table-trigger table-master" id="dataTableTriggerId_001">
                          <thead>
                            <tr class="bgcolor--gray_mm color--gray_d">
                              <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                              <th><span class="cellcontent">رقم المسلسل</span></th>
                              <th><span class="cellcontent">الصور</span></th>
                              <th><span class="cellcontent">العنوان</span></th>
                              <th><span class="cellcontent">الوصف</span></th>
                              <th><span class="cellcontent">الحالة</span></th>
                              <th><span class="cellcontent">الاجراءات</span></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
                            </tr>
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">5</span></td>
                              <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                              <td><span class="cellcontent">El batraa jordan</span></td>
                              <td><span class="cellcontent">jordan</span></td>
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i><i class = "fa icon-in-table-false fa-times"></i></span></td>
                              <td><span class="cellcontent"><a href= offers_and_deals_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a onclick="delete_btn_action()" href="#"  class= " action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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