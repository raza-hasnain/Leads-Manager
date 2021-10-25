 $(document).ready(function() 
 {
  "use strict";
      let total ="";
      var activeurl = baseUrl+'showactivtye';
      getAjaxView(activeurl,data=null,'activity-list',false,'get');
      
      var taskurl = baseUrl+"task/show_own";
           
            getAjaxView(taskurl,data=null,'task',false,'get');
          //for pi and line chart
    var successcallback=function(a)
    {
          if(a.status == 'success')
      {
            var labelsdata = [];
            var labelValue = [];
            var labelColor = [];
            var labelHoverColor = [];
            for(var key in a.data)
            {
              labelsdata.push(key);
              labelValue.push(a.data[key]); 
              labelColor.push(_color.sample());
              labelHoverColor.push(random_rgba());
            }
          total = a.total; 
          var ctx = document.getElementById("doughutChart");
          Chart.pluginService.register(
          {
            beforeDraw: function (chart) 
            {
              if (chart.config.options.elements.center) 
              {
              //Get ctx from string
              var ctx = chart.chart.ctx;
               //Get options from the center object in options
              var centerConfig = chart.config.options.elements.center;
              var fontStyle = centerConfig.fontStyle || 'Arial';
              var txt = centerConfig.text;
              var color = centerConfig.color || '#000';
              var sidePadding = centerConfig.sidePadding || 20;
              var sidePaddingCalculated = (sidePadding/100) * (chart.innerRadius * 2)
              //Start with a base font of 30px
              ctx.font = "50px " + fontStyle;
              //Get the width of the string and also the width of the element minus 10 to give it 5px side padding
              var stringWidth = ctx.measureText(txt).width;
              var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;
              // Find out how much the font can grow in width.
              var widthRatio = elementWidth / stringWidth;
              var newFontSize = Math.floor(30 * widthRatio);
              var elementHeight = (chart.innerRadius * 2);
              // Pick a new font size so it will not be larger than the height of label.
              var fontSizeToUse = Math.min(newFontSize, elementHeight);
              //Set font settings to draw it correctly.
              ctx.textAlign = 'center';
              ctx.textBaseline = 'middle';
              var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
              var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
              ctx.font = fontSizeToUse+"px " + fontStyle;
              ctx.fillStyle = color;
              //Draw text in center
              ctx.fillText(txt, centerX, centerY);
              }
            }
          });
         var backgroundColordata = [];
         if(total !=0) {
         var myChart = new Chart(ctx, 
            {
              type: 'doughnut',
              data: 
              {
                datasets: 
                [{
                  data: labelValue,
                  backgroundColor: labelColor,
                  hoverBackgroundColor: labelHoverColor,
                }],
                  labels: labelsdata
              },
              options: 
              {

                responsive: true,
                cutoutPercentage: 80,
                elements: 
                {
                  center: 
                  {
                    text: total,
                    color: "#10595F", // Default is #000000
                    fontStyle: 'Roboto', // Default is Arial
                    sidePadding: 20 // Defualt is 20 (as a percentage)
                  }
                }
              }
            });
       }
                   
        }
          var week = a.date.reverse();
          var linelabels = a.source;
          var data_1 = [];
          var data_2 = [];
          var data_3 = [];
          var data_4 = [];
          var vale = [];
            for(var key in a.data1)
            {
              vale.push(
              {
                label: key,
                borderWidth: "2",
                borderColor: "rgba(0,0,0,.09)",
                data: a.data1[key].reverse() 
              })
               
        
            }
        //end pi
        //line chart
        var ctx = document.getElementById("lineChart");
        
        var myChart = new Chart(ctx, 
        {
          type: 'line',
            data: 
            {
              labels: week,
              datasets: vale
            },
          options: 
            {
              responsive: true,
              tooltips: 
              {
              mode: 'index',
              intersect: false
              },
              hover: 
              {
              mode: 'nearest',
              intersect: true
              }
    
            }
        });
        //line chart
    }//end successcallback
        //call pi and line using ajax
         var url=baseUrl+'customer/test';
        
        getAjaxdata(url,successcallback);


    var successcallback_lead_statistics = function(a)
    {
           var weeklead = a.date.reverse();
      var linelabels = a.source;
    
      var value = [];
        for(var key in a.data1)
        {
          value.push(
          {
            label: key,
            borderWidth: "2",
            backgroundColor:_color.sample(),
            borderColor: _color.sample(),
            data: a.data1[key].reverse() 
          });
        }
     
        var ctx3 = document.getElementById("lineChart3");
        //line chart view
        var myChart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: weeklead,
                datasets: value
    
            },
            options: {
                responsive: true,
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                }
            }
        });
    }
         var url_lead=baseUrl+'leads/statistics';
        
        getAjaxdata(url_lead,successcallback_lead_statistics);


     var successcallback_invoice= function(a)
    {
          if(a.status == 'success')
            {
        var labelsdata = [];
        var labelValue = [];
        var labelColor = [];
        var labelHoverColor = [];
        for(var key in a.data)
        {
          labelsdata.push(key);
          labelValue.push(a.data[key]); 
          labelColor.push(_color.sample());
          labelHoverColor.push(random_rgba());
        }
      total = a.total 
      var ctx2 = document.getElementById("doughutChart2");
      Chart.pluginService.register(
      {
        beforeDraw: function (chart) 
        {
          if (chart.config.options.elements.center) 
          {
          //Get ctx from string
          var ctx = chart.chart.ctx;
           //Get options from the center object in options
          var centerConfig = chart.config.options.elements.center;
          var fontStyle = centerConfig.fontStyle || 'Arial';
          var txt = centerConfig.text;
          var color = centerConfig.color || '#000';
          var sidePadding = centerConfig.sidePadding || 20;
          var sidePaddingCalculated = (sidePadding/100) * (chart.innerRadius * 2)
          //Start with a base font of 30px
          ctx.font = "50px " + fontStyle;
          //Get the width of the string and also the width of the element minus 10 to give it 5px side padding
          var stringWidth = ctx.measureText(txt).width;
          var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;
          // Find out how much the font can grow in width.
          var widthRatio = elementWidth / stringWidth;
          var newFontSize = Math.floor(30 * widthRatio);
          var elementHeight = (chart.innerRadius * 2);
          // Pick a new font size so it will not be larger than the height of label.
          var fontSizeToUse = Math.min(newFontSize, elementHeight);
          //Set font settings to draw it correctly.
          ctx.textAlign = 'center';
          ctx.textBaseline = 'middle';
          var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
          var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
          ctx.font = fontSizeToUse+"px " + fontStyle;
          ctx.fillStyle = color;
          //Draw text in center
          ctx.fillText(txt, centerX, centerY);
          }
        }
      });
            var backgroundColordata = [] 
            if(total !=0){
            var myChart = new Chart(ctx2, 
            {
              type: 'doughnut',
              data: 
              {
                datasets: 
                [{
                  data: labelValue,
                  backgroundColor: labelColor,
                  hoverBackgroundColor: labelHoverColor,
                }],
                  labels: labelsdata
              },
              options: 
              {
                responsive: true,
                cutoutPercentage: 80,
                elements: 
                {
                  center: 
                  {
                    text: total,
                    color: "#10595F", // Default is #000000
                    fontStyle: 'Roboto', // Default is Arial
                    sidePadding: 20 // Defualt is 20 (as a percentage)
                  }
                }
              }
            });
          }
                   
          }

    }

        var url_invoice = baseUrl+'sales/dasboard_statistics';
        getAjaxdata(url_invoice,successcallback_invoice); 

        //for customer report
        var successcallback_customer = function(a)
        {
          
          $('#converted_customer').text(a.converted_from+'/'+a.coustomer_total);
          $('#facebook_Customer').text(a.facebooCount+'/'+a.coustomer_total);
            var converted_customer_progress = 100*a.converted_from/a.coustomer_total;
            
            var facebook_Customer_progress = 100*a.facebooCount/a.coustomer_total;
            
          $('#converted_customer_progress').css("width", converted_customer_progress+"%");
          $('#facebook_Customer_progress').css("width", facebook_Customer_progress+"%");
        }

        var url_customer = baseUrl+'customer/count_customer';
        getAjaxdata(url_customer,successcallback_customer); 

          //for lead report
        var successcallback_lead = function(a)
        {
          
          
          $('#facebook_lead').text(a.facebooCount+'/'+a.lead_total);
           
            
            var facebook_lead_progress = 100*a.facebooCount/a.lead_total;
            
         
          $('#facebook_lead_progress').css("width", facebook_lead_progress+"%");
        }

        var url_lead_report = baseUrl+'leads/count_lead';
        getAjaxdata(url_lead_report,successcallback_lead);

        //for estimates report
        var successcallback_estimate = function(a)
        {
          
          
          $('#estimates_count').text(a.estimateCount+'/'+a.estimate_total);
           
            
            var estimates_count_progress = 100*a.estimateCount/a.estimate_total;
            
         
          $('#estimates_count_progress').css("width", estimates_count_progress+"%");
        }

        var url_estimate = baseUrl+'sales/count_estimate';
        getAjaxdata(url_estimate,successcallback_estimate);  
    

});