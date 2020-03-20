$(document).ready(function(){    
    $("#year_revenue").html(year); 
    $.get("index.php/admin/ajax/charts/"+year,function(data){ 
      // var users =  json_encode(data) 
   
      Highcharts.chart('charts_con', {
          title: {
              text: 'Revenue by month, ' + year
          },
          subtitle: {
              text: 'Localif3'
          },
            xAxis: {
              categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
          },
          yAxis: {
              title: {
                  text: 'VND'
              }
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle'
          },
          plotOptions: {
              series: {
                  allowPointSelect: true
              }
          },
          series: [{
              name: 'Revenue',
              data: data
          }],
          responsive: {
              rules: [{
                  condition: {
                      maxWidth: 500
                  },
                  chartOptions: {
                      legend: {
                          layout: 'horizontal',
                          align: 'center',
                          verticalAlign: 'bottom'
                      }
                  }
              }]
          }
      });
    });    
  });

  $("#next-year").click(function(){
    $("#year_revenue").html(year);
    $.get("index.php/admin/ajax/charts/"+year,function(data){ 
        // var users =  json_encode(data) 
     
        Highcharts.chart('charts_con', {
            title: {
                text: 'Revenue by month, ' + year
            },
            subtitle: {
                text: 'Localif3'
            },
              xAxis: {
                categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
            },
            yAxis: {
                title: {
                    text: 'VND'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Revenue',
                data: data
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
      });    
  });  
  $("#previous-year").click(function(){
    $("#year_revenue").html(year);
    $.get("index.php/admin/ajax/charts/"+year,function(data){ 
        // var users =  json_encode(data) 
     
        Highcharts.chart('charts_con', {
            title: {
                text: 'Revenue by month, ' + year
            },
            subtitle: {
                text: 'Localif3'
            },
              xAxis: {
                categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
            },
            yAxis: {
                title: {
                    text: 'VND'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Revenue',
                data: data
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
      });    
  });  