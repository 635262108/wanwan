$.fn.selectDate = function(){
			var minYear = 1900
			var maxYear = (new Date).getFullYear()
			var yearSel = document.getElementById('year')
			var monthSel = document.getElementById('month')
			var daySel = document.getElementById('days')
			
			var yearTwo=document.getElementById('year_two')
			var monthTwo=document.getElementById('month_two')
			var dayTwo=document.getElementById('day_two')
	
			for(var y = maxYear;y >= minYear;y--){
				var yearOpt = document.createElement('option')
				yearOpt.value = y
				yearOpt.innerHTML = y
				yearSel.appendChild(yearOpt)
				
			}
			
			for(var y = maxYear;y >= minYear;y--){
				var yearOpt = document.createElement('option')
				yearOpt.value = y
				yearOpt.innerHTML = y
				yearTwo.appendChild(yearOpt)
				
			}
//          第一个生日
			$("#year").change(function(event){
				removeOption(monthSel)
				addOption(12,monthSel)
				removeOption(daySel)
			})
//			第二个生日
			$("#year_two").change(function(event){
				removeOption(monthTwo)
				addOption(12,monthTwo)
				removeOption(dayTwo)
			})

			$("#month").change(function(){
				removeOption(daySel)
				var year = $("#year option:selected").val()
				var month = $("#month option:selected").val()
				if(month==1 || month==3 || month==5 || month==7 || month==8 || month==10 || month==12){
					addOption(31,daySel)
				}else if(month==4 || month==6 || month==9 || month==11){
					addOption(30,daySel)
				}else if(month==2){
					if((year%4 == 0 && year%100 != 0 ) || (year%400 == 0)){
						addOption(29,daySel)
					}else{	
						addOption(28,daySel)
					}
				}
			})
			
			
			$("#month_two").change(function(){
				removeOption(dayTwo)
				var year = $("#year_two option:selected").val()
				var month = $("#month_two option:selected").val()
				if(month==1 || month==3 || month==5 || month==7 || month==8 || month==10 || month==12){
					addOption(31,dayTwo)
				}else if(month==4 || month==6 || month==9 || month==11){
					addOption(30,dayTwo)
				}else if(month==2){
					if((year%4 == 0 && year%100 != 0 ) || (year%400 == 0)){
						addOption(29,dayTwo)
					}else{	
						addOption(28,dayTwo)
					}
				}
			})

			function addOption(num,parent){
				//parent：父对象
				//unit：单位（年/月/日）
				 //num：选项个数
				for(var index=1;index <= num;index++){
					var opt =document.createElement('option')
					$(opt).attr('value',index)
					if(index<10){index = '0'+index}
					$(opt).html(index)
					$(parent).append(opt)
				}
			}
			
			function removeOption(parent){
				//parent：父对象
				var options = $(parent).find('option')
				for(var index = 1;index < options.length;index++){
					parent.removeChild(options[index])
				}
			}
		}