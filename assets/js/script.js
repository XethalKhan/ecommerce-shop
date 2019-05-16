$(document).ready(function(){

	$("#btnSignup").click(function(){
		var fn = $("#tbFn").val();
		var ln = $("#tbLn").val();
		fn = fn.substring(0, 100).trim();
		ln = ln.substring(0, 100).trim();
		var mail = $("#tbMail").val();
		var user = $("#tbUserSign").val();
		var pass = $("#tbPassSign").val();
		var passRep = $("#tbPassRep").val();
		var status = true;
		
		$(".err").text("");
		$("#errList").text("");

		if(fn == ""){
			status = false;
			$("#errList").append("Firstname must not be blank!<br/>");
			$("#fnErr").text("*");
		}
		if(ln == ""){
			status = false;
			$("#errList").append("Lastname must not be blank!<br/>");
			$("#lnErr").text("*");
		}
		if(!(/^[a-zA-Z0-9_%+-]+(\.[a-zA-Z0-9_%+-]+)*@[a-z\.\-]+\.[a-z]{2,3}$/.test(mail))){
			status = false;
			$("#errList").append("E-mail is not in valid format!<br/>");
			$("#mailErr").text("*");
		}
		if(!(/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!]).{6,20})$/.test(pass))){
			status = false;
			$("#errList").append(
				"Password is not valid (at least one digit, small leter," +
				" big letter and special character !$@%#)<br/>");
			$("#passErr").text("*");
		}
		if(!(/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!]).{6,20})$/.test(passRep))){
			status = false;
			$("#errList").append(
				"Repeated password is not valid (at least one digit, small leter," +
				" big letter and special character !$@%#)<br/>");
			$("#passRepErr").text("*");
		}
		if(!(pass == passRep)){
			status = false;
			$("#errList").append("Password and repeated password do not match!<br/>");
			$("#passErr").text("*");
			$("#passRepErr").text("*");
		}

		if(status){
			$.ajax({
				url: "127.0.0.1/utl/signup.php",
				type: "post",
				dataType: "json",
				data: {
					status: status,
					fn: fn,
					ln: ln,
					mail: mail,
					user: user,
					pass: pass
				},
				success: function(data, txt, xhr){
					alert(xhr.status);
				},
				error: function(xhr, status, error){
					if(xhr.status == 400){
						$(".err").text("");
						$("#errList").text("");
						var data = JSON.parse(xhr.responseText);
						var cnt = data.length;
						for(i = 0; i < cnt; i++){
							$("#errList").append(data[i]["msg"] + "<br/>");
							$("#" + data[i]["id"]).text("*");
						}
					}
				}
			})
		}
	});

	$("#ddlLearn").change(function(){
		var test = $("#ddlLearn option:selected").val();
		if(test == 4){
			$("#tbOther").prop('disabled', false);
		}
		else{
			$("#tbOther").prop('disabled', true);
		}
	});

	$("#btnSurvey").click(function(){
		var gender = $("#rbGender:checked").val();
		var learnVal = $("#ddlLearn option:selected").val();
		var learnTxt = null;
		var p = $("#chkProdType:checked");
		var products = [];
		p.each(function(){
			products.push($(this).val());
		});
		var prodGrade = $("#tbProductOffer").val();
		var deliveryGrade = $("#tbDelivery").val();
		var comm = $("#txtComm").val();
		status = true;

		$(".err").text("");
		$("#errList").text("");

		if(learnVal == 4){
			learnTxt = $("#tbOther").val();
		}
		else{
			learnTxt = $("#ddlLearn option:selected").text();
		}

		if(learnVal == 0){
			status = false;
			$("#lnValErr").text("*");
			$("#errList").append("Choose how did you find out about us!<br/>");
		}

		if(learnVal == 4 && learnTxt.length < 4){
			status = false;
			$("#lnTxtErr").text("*");
			$("#errList").append("Be more precise how did you find out about us!<br/>");
		}

		if(products.length == 0){
			status = false;
			$("#prodTypeErr").text("*");
			$("#errList").append("Choose at least one type of product you would like to be added in our offer!<br/>");
		}

		if((/^(0[1-9]|[1-9]|10)$/.test(prodGrade))){  
			prodGrade = parseInt(prodGrade);
			if(prodGrade < 1 || prodGrade > 10){
				status = false;
				$("#prodGradeErr").text("*");
				$("#errList").append("Grade our product offer from 1 to 10!<br/>");
			}
		}
		else{
			status = false;
			$("#prodGradeErr").text("*");
			$("#errList").append("Grade our product offer from 1 to 10!<br/>");
		}

		if((/^(0[1-9]|[1-9]|10)$/.test(deliveryGrade))){  
			deliveryGrade = parseInt(deliveryGrade);
			if(deliveryGrade < 1 || deliveryGrade > 10){
				status = false;
				$("#delivGradeErr").text("*");
				$("#errList").append("Grade our delivery system from 1 to 10!<br/>");
			}
		}
		else{
			status = false;
			$("#delivGradeErr").text("*");
			$("#errList").append("Grade our delivery system from 1 to 10!<br/>");
		}

		if(status){
			$.ajax({
				url: "127.0.0.1/utl/survey.php",
				type: "post",
				dataType: "json",
				data: {
					status: status,
					gender: gender,
					learnVal: learnVal,
					learnTxt: learnTxt,
					products: products,
					prodGrade: prodGrade,
					deliveryGrade: deliveryGrade,
					comment: comm
				},
				success: function(data, txt, xhr){
					if(xhr.status == 200){
						alert("Thank you for your time");
						window.open("index.php", "_self");
					}
				},
				error: function(xhr, status, error){
					if(xhr.status == 401){
						window.open("login.php", "_self");
					}
				}
			})
		}
	});

	$("#btnChangePass").click(function(){
		var old = $("#tbOld").val();
		var newPass = $("#tbNewPass").val();
		var newPassRep = $("#tbNewPassRep").val();
		var status = true;
		
		$(".err").text("");
		$("#errList").text("");

		if(!(/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!]).{6,20})$/.test(old))){
			status = false;
			$("#errList").append(
				"Old password is not valid (at least one digit, small leter," +
				" big letter and special character !$@%#)<br/>");
			$("#oldErr").text("*");
		}
		if(!(/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!]).{6,20})$/.test(newPass))){
			status = false;
			$("#errList").append(
				"New password is not valid (at least one digit, small leter," +
				" big letter and special character !$@%#)<br/>");
			$("#newPassErr").text("*");
		}
		if(!(/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!]).{6,20})$/.test(newPassRep))){
			status = false;
			$("#errList").append(
				"Repeated new password is not valid (at least one digit, small leter," +
				" big letter and special character !$@%#)<br/>");
			$("#newPassRepErr").text("*");
		}
		if(!(newPass == newPassRep)){
			status = false;
			$("#errList").append("New password and repeated new password do not match!<br/>");
			$("#newPassErr").text("*");
			$("#newPassRepErr").text("*");
		}
		if(!(newPass != old)){
			status = false;
			$("#errList").append("New password and old password match!<br/>");
			$("#oldErr").text("*");
			$("#newPassErr").text("*");
		}

		if(status){
			$.ajax({
				url: "127.0.0.1/utl/changePass.php",
				type: "post",
				dataType: "json",
				data: {
					old: old,
					new: newPass,
					newRep: newPassRep
				},
				success: function(data, txt, xhr){
					window.open("utl/logout.php", "_self");
				},
				error: function(xhr, status, error){
					if(xhr.status == 400){
						$(".err").text("");
						$("#errList").text("");
						var data = JSON.parse(xhr.responseText);
						var cnt = data.length;
						for(i = 0; i < cnt; i++){
							$("#errList").append(data[i]["msg"] + "<br/>");
							$("#" + data[i]["id"]).text("*");
						}
					}
				}
			})
		}
	});

	$("#txtTicket").on("keydown", function(e){
		var txt = $("#txtTicket").val();
		if(txt.length < 50){
			$("#txtErr").text("*");
		}else{
			$("#txtErr").text("");
		}
	});

	$("#btnNewTicket").click(function(){
		var txt = $("#txtTicket").val();
		var status = true;

		$("#txtErr").text("");
		if(txt.length < 50){
			alert("Request must be at least 50 characters long");
			status = false;
		}

		if(status == true){
			$.ajax({
				url: "127.0.0.1/utl/newTicket.php",
				type: "post",
				dataType: "json",
				data: {
					txtTicket: txt
				},
				success: function(data, txt, xhr){
					alert("Your ticket number is " + data);
					$("#txtTicket").val("");
				},
				error: function(xhr, status, error){
					$(".err").text("");
					$("#errList").text("");
					var data = JSON.parse(xhr.responseText);
					var cnt = data.length;
					for(i = 0; i < cnt; i++){
						$("#errList").append(data[i]["msg"] + "<br/>");
						$("#" + data[i]["id"]).text("*");
					}
				}
			})
		}
	});

	$("#btnSearchProducts").click(function(){
		var name = $("#tbName").val();
		var maxPrice = $("#tbMaxPrice").val();
		var minPrice = $("#tbMinPrice").val();
		var cat = $("#ddlSearchCategory option:selected").val();
		var discount = $("#cbxDiscount").prop("checked");
		var stock = $("#cbxStock").prop("checked");


		$(".err").text("");
		$("#errList").text("");

		if(!(/(^[+|-]?\d*\.?\d*[0-9]+\d*$)|(^[+|-]?[0-9]+\d*\.\d*$)/.test(maxPrice)) && maxPrice != ""){
			maxPrice = "";
			$("#errList").append("Value for max price is not valid number!<br/>");
			$("#maxPErr").text("*");
		}

		if(!(/(^[+|-]?\d*\.?\d*[0-9]+\d*$)|(^[+|-]?[0-9]+\d*\.\d*$)/.test(minPrice)) && minPrice != ""){
			minPrice = "";
			$("#errList").append("Value for min price is not valid number!<br/>");
			$("#minPErr").text("*");
		}

		$.ajax({
			url: "127.0.0.1/utl/getProducts.php",
			type: "post",
			dataType: "json",
			data: {
				name: name,
				maxPrice: maxPrice,
				minPrice: minPrice,
				cat: cat,
				discount: discount,
				stock: stock
			},
			success: function(data, txt, xhr){
				$("#main").html("");
				var cnt = data.length;
				var app = "";
				for(var i = 0; i< cnt; i++){
					if(i%3 == 0){
						app = app + "<div class=\"row search-row\">";
					}
					app = app +
						"<div class=\"search-prod col-sm-4\">" +
							"<div class=\" text-center\">" +
								"<img src=\"img/prod/" + data[i]["img"] + "\" width=\"auto\" height=\"150\"/>" +
							"</div>" +
							"<div class=\"row search-details\">" +
								"<div class=\"col-sm-9 text-center\">" +
									"<h6>" + data[i]["name"] + "</h6>" +		
								"</div>" +
								"<div class=\"col-sm-3 text-center\">" +
									"<h6 class=\"search-price\">" +
										"$" + parseFloat(Math.round(data[i]["unit_price"] * 100) / 100).toFixed(2) + 
									"</h6>" +
								"</div>" +
							"</div>" +
							"<div class=\"row text-center product-links\">" +
								"<div class=\"col-sm-6\">" +
									"<a href=\"prod.php?pid=" + data[i]["id"] + "\" class=\"search-detail\">Details</a>" +
								"</div>" +
								"<div class=\"col-sm-6\">" +
									"<a href=\"\" class=\"product-action\" data-pid=\"" +  data[i]["id"] +
									 "\" data-cat=\"" +  data[i]["cat_id"] + "\">Purchase</a>" +
								"</div>" +	
							"</div>" +
						"</div>";
					if(i % 3 == 2 || i + 1 == cnt){app = app + "</div>";}
				}
				$("#main").html(app);
			},
			error: function(xhr, status, error){
				alert(xhr.status);	
			}
		});
	});

	$("#btnSearchOrders").click(function(){
		var customer = $("#tbCustomer").val();
		var maxF = $("#tbMaxFreight").val();
		var minF = $("#tbMinFreight").val();
		var city = $("#tbCity").val();
		var country = $("#tbCountry").val();
		var address = $("#tbAddress").val();
		var orderDate = $("#tbOrderDate").val();

		$(".err").text("");
		$("#errList").text("");

		if(!(/(^[+|-]?\d*\.?\d*[0-9]+\d*$)|(^[+|-]?[0-9]+\d*\.\d*$)/.test(maxF)) && maxF != ""){
			maxF = "";
			$("#errList").append("Value for max freight is not valid number!<br/>");
			$("#maxfErr").text("*");
		}

		if(!(/(^[+|-]?\d*\.?\d*[0-9]+\d*$)|(^[+|-]?[0-9]+\d*\.\d*$)/.test(minF)) && minF != ""){
			minF = "";
			$("#errList").append("Value for min freight is not valid number!<br/>");
			$("#minfErr").text("*");
		}

		if(!(/(0[1-9]|[1-2][0-9]|3[0-1])\.(0[1-9]|1[0-2])\.(19[0-9][0-9]|20[0-5][0-9])/.test(orderDate)) && orderDate != ""){
			orderDate = "";
			$("#errList").append("Order date is not in valid format, must be written like dd.mm.yyyy from 1900 to 2050!<br/>");
			$("#orderDateErr").text("*");
		}

		$.ajax({
			url: "127.0.0.1/utl/getOrders.php",
			type: "post",
			dataType: "json",
			data: {
				customer: customer,
				maxF: maxF,
				minF: minF,
				city: city,
				country: country,
				address: address,
				orderDate: orderDate
			},
			success: function(data, txt, xhr){
				$("#orderTable").find("tr:gt(0)").remove();
				var cnt = data.length;
				for(var i = 0; i < cnt; i++){
				$('#orderTable > tbody:last-child')
					.append(
						'<tr>' + 
							'<td>' + data[i]["id"] + '</td>' + 
							'<td>' + data[i]["username"] + '</td>' + 
							'<td>' + data[i]["order_date"].substring(8, 10) + 
								'.' + data[i]["order_date"].substring(5, 7) + 
								'.' + data[i]["order_date"].substring(0, 4) + 
							'</td>' +
							'<td>' + data[i]["freight"] + '</td>' +
							'<td>' + data[i]["address"] + '</td>' + 
							'<td>' + data[i]["city"] + '</td>' +
						'</tr>');
				}
			},
			error: function(xhr, status, error){
				alert(xhr.status);	
			}
		});
	});

	$("#btnSearchTickets").click(function(){
		var id = $("#tbID").val();
		var date = $("#tbTicketDate").val();
		var customer = $("#tbCustomer").val();

		$(".err").text("");
		$("#errList").text("");

		if(!(/(0[1-9]|[1-2][0-9]|3[0-1])\.(0[1-9]|1[0-2])\.(19[0-9][0-9]|20[0-5][0-9])/.test(date)) && date != ""){
			date = "";
			$("#errList").append("Order date is not in valid format, must be written like dd.mm.yyyy from 1900 to 2050!<br/>");
			$("#ticketDateErr").text("*");
		}

		$.ajax({
			url: "127.0.0.1/utl/getTickets.php",
			type: "post",
			dataType: "json",
			data: {
				id: id,
				date: date,
				customer: customer
			},
			success: function(data, txt, xhr){
				$("#ticketTable").find("tr:gt(0)").remove();
				var cnt = data.length;
				for(var i = 0; i < cnt; i++){
				$('#ticketTable > tbody:last-child')
					.append(
						'<tr>' + 
							'<td>' + data[i]["id"] + '</td>' + 
							'<td>' + data[i]["username"] + '</td>' + 
							'<td>' + data[i]["date"].substring(8, 10) + 
								'.' + data[i]["date"].substring(5, 7) + 
								'.' + data[i]["date"].substring(0, 4) + 
							'</td>' +
							'<td>' + data[i]["request"] + '</td>' +
							'<td>' + 
								'<a href=\"#\ class=\"solve-ticket\" data-id=\"' + data[i]["id"] + '>Solved</a>' +
								'<a href=\"#\ class=\"dissmiss-ticket\" data-id=\"' + data[i]["id"] + '>Dissmiss</a>' +
							 '</td>' + 
						'</tr>');
				}
			},
			error: function(xhr, status, error){
				if(xhr.status == 404){
					$("#errList").append("Nothing found<br/>");
				}
			}
		});
	});

	$("#ticketTable").on("click", ".solve-ticket", function(e){
		var tid = $(this).data("id");
		$.ajax({
			url: "127.0.0.1/utl/solveTicket.php",
			type: "post",
			dataType: "json",
			data: {
				id: tid
			},
			success: function(data, txt, xhr){
				if(xhr.status == 200){

					var id = $("#tbID").val();
					var date = $("#tbTicketDate").val();
					var customer = $("#tbCustomer").val();

					$.ajax({
						url: "127.0.0.1/utl/getTickets.php",
						type: "post",
						dataType: "json",
						data: {
							id: id,
							date: date,
							customer: customer
						},
						success: function(data, txt, xhr){
							$("#ticketTable").find("tr:gt(0)").remove();
							var cnt = data.length;
							for(var i = 0; i < cnt; i++){
							$('#ticketTable > tbody:last-child')
								.append(
									'<tr>' + 
										'<td>' + data[i]["id"] + '</td>' + 
										'<td>' + data[i]["username"] + '</td>' + 
										'<td>' + data[i]["date"].substring(8, 10) + 
											'.' + data[i]["date"].substring(5, 7) + 
											'.' + data[i]["date"].substring(0, 4) + 
										'</td>' +
										'<td>' + data[i]["request"] + '</td>' +
										'<td>' + 
											'<a href=\"#\" class=\"solve-ticket\" data-id=\"' + data[i]["id"] + '\">Solved</a><br/>' +
											'<a href=\"#\" class=\"dissmiss-ticket\" data-id=\"' + data[i]["id"] + '\">Dissmiss</a>' +
										 '</td>' + 
									'</tr>');
							}
						},
						error: function(xhr, status, error){
							if(xhr.status == 404){
								$("#ticketTable").find("tr:gt(0)").remove();
							}
						}
					});
				}
			},
			error: function(xhr, status, error){
			}
		});
	});

	$("#ticketTable").on("click", ".dismiss-ticket", function(e){
		var tid = $(this).data("id");
		$.ajax({
			url: "127.0.0.1/utl/dissmissTicket.php",
			type: "post",
			dataType: "json",
			data: {
				id: tid
			},
			success: function(data, txt, xhr){
				if(xhr.status == 200){

					var id = $("#tbID").val();
					var date = $("#tbTicketDate").val();
					var customer = $("#tbCustomer").val();

					$.ajax({
						url: "127.0.0.1/utl/getTickets.php",
						type: "post",
						dataType: "json",
						data: {
							id: id,
							date: date,
							customer: customer
						},
						success: function(data, txt, xhr){
							$("#ticketTable").find("tr:gt(0)").remove();
							var cnt = data.length;
							for(var i = 0; i < cnt; i++){
							$('#ticketTable > tbody:last-child')
								.append(
									'<tr>' + 
										'<td>' + data[i]["id"] + '</td>' + 
										'<td>' + data[i]["username"] + '</td>' + 
										'<td>' + data[i]["date"].substring(8, 10) + 
											'.' + data[i]["date"].substring(5, 7) + 
											'.' + data[i]["date"].substring(0, 4) + 
										'</td>' +
										'<td>' + data[i]["request"] + '</td>' +
										'<td>' + 
											'<a href=\"#\ class=\"solve-ticket\" data-id=\"' + data[i]["id"] + '>Solved</a>' +
											'<a href=\"#\ class=\"dissmiss-ticket\" data-id=\"' + data[i]["id"] + '>Dissmiss</a>' +
										 '</td>' + 
									'</tr>');
							}
						},
						error: function(xhr, status, error){
							if(xhr.status == 404){
								$("#ticketTable").find("tr:gt(0)").remove();
							}
						}
					});
				}
			},
			error: function(xhr, status, error){
			}
		});
	});

	$("#catTable").on("click", ".cat-update", function(){
		var row = $(this).parent().parent();
		var name = row.find(".cat-name").text();
		var desc = row.find(".cat-desc").text();
		var id = $(this).data("id");
		$("#tbName").val(name);
		$("#txtDesc").val(desc);
		$("#catID").val(id);
		$("#btnInsertCategory").val("Update");
	});

	$("#btnResetCategory").click(function(){
		$("#tbName").val("");
		$("#txtDesc").val("");
		$("#catID").val("");
		$("#btnInsertCategory").val("Insert");
	});

	$("#btnInsertCategory").click(function(){
		var val = $(this).val();
		var name = $("#tbName").val();
		var desc = $("#txtDesc").val();
		alert(val);
		if(val == "Insert"){
			$.ajax({
				url: "127.0.0.1/utl/insertCat.php",
				type: "post",
				dataType: "json",
				data: {
					name: name,
					desc: desc
				},
				success: function(data, txt, xhr){
					console.log(data);
				},
				error: function(xhr, status, error){
					if(xhr.status == 401){
						window.open("login.php", "_self");
					}
				}
			});	
		}else if(val == "Update"){
			var id = $("#catID").val();

			$.ajax({
				url: "127.0.0.1/utl/updateCat.php",
				type: "post",
				dataType: "json",
				data: {
					id: id,
					name: name,
					desc: desc
				},
				success: function(data, txt, xhr){
					console.log(data);
				},
				error: function(xhr, status, error){
					if(xhr.status == 401){
						window.open("login.php", "_self");
					}
				}
			});		
		}else{
			alert("Something is wrong");
		}
	});

	$("#btnSearchCategory").click(function(){
		var name = $("#tbName").val();

		$.ajax({
				url: "127.0.0.1/utl/getCat.php",
				type: "post",
				dataType: "json",
				data: {
					name: name
				},
				success: function(data, txt, xhr){
					if(xhr.status == 200){
						$("#catTable").find("tr:gt(0)").remove();
						var cnt = data.length;
						for(var i = 0; i < cnt; i++){
						$('#catTable > tbody:last-child')
							.append(
								'<tr>' + 
									'<td class=\"cat-name\">' + data[i]["name"] + '</td>' + 
									'<td class=\"cat-desc\">' + data[i]["info"] + '</td>' + 
									'<td>' + 
										'<a href=\"#\" class=\"cat-update\" data-id=\"' + data[i]["id"] + '\">Update</a>' +
									 '</td>' + 
								'</tr>');
						}
					}
				},
				error: function(xhr, status, error){
					if(xhr.status == 404){
						$("#catTable").find("tr:gt(0)").remove();
					}
				}
			});
	});

	$("#btnSearchUsers").click(function(){
		var user = $("#tbCustomer").val();
		var fn = $("#tbFn").val();
		var ln = $("#tbLn").val();
		var mail = $("#tbMail").val();
		var status = $("#ddlStatus option:selected").val();

		$.ajax({
				url: "127.0.0.1/utl/getUsers.php",
				type: "post",
				dataType: "json",
				data: {
					user: user,
					fn: fn,
					ln: ln,
					mail: mail,
					status: status
				},
				success: function(data, txt, xhr){
					if(xhr.status == 200){
						$("#userTable").find("tr:gt(0)").remove();
						var cnt = data.length;
						for(var i = 0; i < cnt; i++){
							var status = "";
							switch(data[i]["status"]){
								case "0":
									status = "Active";
									break;
								case "1":
									status = "Disabled";
									break;
								case "2":
									status = "Wrong passwords";
									break;
								default:
									status = "N/A";
							}
						$('#userTable > tbody:last-child')
							.append(
								'<tr>' + 
									'<td class=\"cat-name\">' + data[i]["username"] + '</td>' + 
									'<td class=\"cat-desc\">' + data[i]["firstname"] + '</td>' + 
									'<td class=\"cat-desc\">' + data[i]["lastname"] + '</td>' +
									'<td class=\"cat-desc\">' + data[i]["email"] + '</td>' +
									'<td class=\"cat-desc\">' + status + '</td>' +
									'<td>' + 
										'<a href=\"profile.php?uid=' + data[i]["id"] + '\">Profile</a>' +
									 '</td>' + 
								'</tr>');
						}
					}
				},
				error: function(xhr, status, error){
					if(xhr.status == 404){
						$("#userTable").find("tr:gt(0)").remove();
					}
				}
			});
	});

	function checkProdUpload(){
		var name = $("#tbName").val();
		var shortDesc = $("#tbShortDesc").val();
		var longDesc = $("#tbLongDesc").val();
		var ddlCat = $("#ddlProdCategory option:selected").val();
		var unit = $("#tbUnit").val();
		var unitPrice = $("#tbUnitPrice").val();
		var unitStock = $("#tbUnitStock").val();
		var discount = $("#tbDiscount").val();
		var status = true;

		$(".err").text("");
		$("#errList").text("");

		if(name.length > 150 || name.length < 5){
			status = false;
			$("#errList").append("Name must be at least 5 characters and less then 150!<br/>");
			$("#lnErr").text("*");
		}
		if(shortDesc.length > 250 || shortDesc.length < 25){
			status = false;
			$("#errList").append("Short description must be at least 25 characters and less then 250!<br/>");
			$("#shortDescErr").text("*");
		}
		if(longDesc.length > 2500 || longDesc.length < 100){
			status = false;
			$("#errList").append("Long description must be at least 100 characters and less then 2500!<br/>");
			$("#longDescErr").text("*");
		}
		if(ddlCat==0){
			status = false;
			$("#errList").append("Category must be selected!<br/>");
			$("#catErr").text("*");
		}
		if(unit == ""){
			status = false;
			$("#errList").append("Unit measurement of product must be specified!<br/>");
			$("#unitErr").text("*");
		}
		if(!(/(^[+|-]?\d*\.?\d*[0-9]+\d*$)|(^[+|-]?[0-9]+\d*\.\d*$)/.test(unitPrice))){
			status = false;
			$("#errList").append("Unit price is not in valid format!<br/>");
			$("#unitPriceErr").text("*");
		}
		if(!(/(^[+|-]?\d*\.?\d*[0-9]+\d*$)|(^[+|-]?[0-9]+\d*\.\d*$)/.test(unitStock))){
			status = false;
			$("#errList").append("Unit stock is not valid number!<br/>");
			$("#unitStockErr").text("*");
		}
		if(!(/(^[+|-]?\d*\.?\d*[0-9]+\d*$)|(^[+|-]?[0-9]+\d*\.\d*$)/.test(discount))){
			status = false;
			$("#errList").append("Discount is not in valid format!<br/>");
			$("#discountErr").text("*");
		}

		return status;
	}

	$(".product-links").on("click", ".product-action", function(e){
		e.preventDefault();
		var pid = $(this).data("pid");
		var cat = $(this).data("cat");
		addToOrder(pid, cat, "add");
	});

	$(".dropdown-menu").on("click", ".plus-prod-add", function(e){
		var pid = $(this).data("pid");
		var cat = "0";
		addToOrder(pid, cat, "add");
	});

	$(".dropdown-menu").on("click", ".remove-prod", function(e){
		var pid = $(this).data("pid");
		var cat = "0";
		addToOrder(pid, cat, 0);
	});

	$(".dropdown-menu").on("click", ".minus-prod-add", function(e){
		var pid = $(this).data("pid");
		var cat = "0";
		addToOrder(pid, cat, "minus");
	});

	$("#order-from-prod").on("click", ".plus-prod-add", function(e){
		var pid = $(this).data("pid");
		var cat = "0";
		addToOrder(pid, cat, "add");
		var cnt = parseInt($("#in-prod-num").text());
		$("#in-prod-num").text(cnt + 1);
	});

	$("#order-from-prod").on("click", ".remove-prod", function(e){
		var pid = $(this).data("pid");
		var cat = "0";
		addToOrder(pid, cat, 0);
		$("#in-prod-num").text(0);
	});

	$("#order-from-prod").on("click", ".minus-prod-add", function(e){
		var cnt = parseInt($("#in-prod-num").text());
		cnt = cnt - 1;
		if(cnt >= 0){
			var pid = $(this).data("pid");
		var cat = "0";
		addToOrder(pid, cat, "minus");
			$("#in-prod-num").text(cnt);
		}else{
			$("#in-prod-num").text(0);
		}
	});

	$('.dropdown-menu').click(function(e){
	     e.stopPropagation();
	 });

	function addToOrder(id, cat, number){
		/*
		number = add => +1
		number = minus => -1
		number = int => overwrite
		*/
		$.ajax({
			url: "127.0.0.1/utl/addToOrder.php",
			type: "post",
			dataType: "json",
			data: {
				pid: id,
				cat: cat,
				number: number
			},
			success: function(data, txt, xhr){
				if(xhr.status == 200){
					$(".dropdown-menu").html("");
					var cnt = data.length;
					var items = "";
					for(var i = 0; i < cnt; i++){
						items = items + '<li>' + 
								'&nbsp;&nbsp;&nbsp;' + 
								'<i class=\"fa fa-plus plus-prod-add\" aria-hidden=\"true\" data-pid=\"' + data[i]["id"] + '\"></i>' +
				    			'&nbsp;&nbsp;&nbsp;' + 
				    			'<span class=\"num-of-prod\">' + data[i]["number"] + '</span>' +
				    			'&nbsp;&nbsp;&nbsp;' + 
				    			'<i class=\"fa fa-minus minus-prod-add\" aria-hidden=\"true\" data-pid=\"' + data[i]["id"] + '\"></i>' +
				    			'&nbsp;&nbsp;&nbsp;' + 
				    			'<i class=\"fa fa-times remove-prod\" aria-hidden=\"true\" data-pid=\"' + data[i]["id"] + '\"></i>' +
				    			'&nbsp;&nbsp;&nbsp;' + 
				    			'<a href=\"#\" data-id=\"' + data[i]["id"] + '\">' + data[i]["name"].substr(0, 30) + '</a>' + 
				    		'</li>'
					}
					$(".dropdown-menu").append(items);
					$(".dropdown-menu").append(
						"<li class=\"divider\"><hr/></li>" +
						"<li class=\"text-center\"><a href=\"completeOrder.php\">Complete order</a>");
				}else if(xhr.status == 201){
					$(".dropdown-menu").html("");
					$(".dropdown-menu").append("<li>&nbsp;&nbsp;&nbsp;No products selected</li>");
				}
			},
			error: function(xhr, status, error){
				if(xhr.status == 401){
					window.open("login.php", "_self");
				}
			}
		})
	}
});