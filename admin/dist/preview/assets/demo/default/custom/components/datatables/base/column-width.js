var DatatableColumnWidthDemo=function(){var t=function(){var t=$(".m_datatable").mDatatable({data:{type:"remote",source:{read:{url:"inc/api/datatables/demos/default.php"}},pageSize:10,saveState:{cookie:!0,webstorage:!0},serverPaging:!0,serverFiltering:!1,serverSorting:!0},layout:{theme:"default",class:"",scroll:!1,height:null,footer:!1},sortable:!0,filterable:!1,pagination:!0,columns:[{field:"RecordID",title:"#",sortable:!1,width:40,textAlign:"center",selector:{class:"m-checkbox--solid m-checkbox--brand"}},{field:"OrderID",title:"Order ID",sortable:"asc",filterable:!1,width:150},{field:"Notes",title:"Notes",width:700},{field:"CompanyAgent",title:"Agent"},{field:"ShipDate",title:"Ship Date"},{field:"Actions",width:110,title:"Actions",sortable:!1,overflow:"visible",template:function(t){t.getDatatable().getPageSize(),t.getIndex();return'<span>\t\t\t\t\t\t<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="View details">\t\t\t\t\t\t\t<i class="la la-ellipsis-h"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</a>\t\t\t\t\t</span>'}}]}),e=t.getDataSourceQuery();$("#m_form_search").on("keyup",function(e){var a=t.getDataSourceQuery();a.generalSearch=$(this).val().toLowerCase(),t.setDataSourceQuery(a),t.load()}).val(e.generalSearch),$("#m_form_status, #m_form_type").selectpicker()};return{init:function(){t()}}}();jQuery(document).ready(function(){DatatableColumnWidthDemo.init()});