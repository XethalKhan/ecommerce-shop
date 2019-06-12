$(document).ready(function(){

	$("#btnSignup").click(function(){
		let fn = $("#tbFn").val();
		let ln = $("#tbLn").val();
		fn = fn.substring(0, 100).trim();
		ln = ln.substring(0, 100).trim();
		let mail = $("#tbMail").val();
		let user = $("#tbUserSign").val();
		let pass = $("#tbPassSign").val();
		let passRep = $("#tbPassRep").val();
		let status = true;
		
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
				url: "http://" + BASE_HREF + "user/sign-up",
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
					window.open("http://" + BASE_HREF + "login", "_self");
				},
				error: function(xhr, status, error){
					if(xhr.status == 400){
						$(".err").text("");
						$("#errList").text("");
						let data = JSON.parse(xhr.responseText);
						let cnt = data.length;
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
				url: "http://" + BASE_HREF + "survey/answer",
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
						window.open("http://" + BASE_HREF + "home", "_self");
					}
				},
				error: function(xhr, status, error){
					if(xhr.status == 401){
						window.open("http://" + BASE_HREF + "login", "_self");
					}
				}
			})
		}
	});

	$("#btnChangePass").click(function(){
		let old = $("#tbOld").val();
		let newPass = $("#tbNewPass").val();
		let newPassRep = $("#tbNewPassRep").val();
		let status = true;
		
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
				url: "http://" + BASE_HREF + "user/change-pass",
				type: "post",
				dataType: "json",
				data: {
					old: old,
					new: newPass,
					newRep: newPassRep
				},
				success: function(data, txt, xhr){
					window.open("http://" + BASE_HREF + "user/logout", "_self");
				},
				error: function(xhr, status, error){
					if(xhr.status == 400){
						$(".err").text("");
						$("#errList").text("");
						let data = JSON.parse(xhr.responseText);
						let cnt = data.length;
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
		let txt = $("#txtTicket").val();
		if(txt.length < 50){
			$("#txtErr").text("*");
		}else{
			$("#txtErr").text("");
		}
	});

	$("#btnNewTicket").click(function(){
		let txt = $("#txtTicket").val();
		let status = true;

		$("#txtErr").text("");
		if(txt.length < 50){
			alert("Request must be at least 50 characters long");
			status = false;
		}

		if(status == true){
			$.ajax({
				url: "http://" + BASE_HREF + "ticket/insert",
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
					let data = JSON.parse(xhr.responseText);
					let cnt = data.length;
					for(i = 0; i < cnt; i++){
						$("#errList").append(data[i]["msg"] + "<br/>");
						$("#" + data[i]["id"]).text("*");
					}
				}
			})
		}
	});

	//<Searching products on product-list page with AJAX>
	$("#btnSearchProducts").click(function(){
		let name = $("#tbName").val(); 								//product name
		let maxPrice = $("#tbMaxPrice").val();						//max product price
		let minPrice = $("#tbMinPrice").val();						//min product price
		let cat = $("#ddlSearchCategory option:selected").val();	//category ID
		let discount = $("#cbxDiscount").prop("checked");			//product on discount
		let stock = $("#cbxStock").prop("checked");					//product on stock


		$(".err").text("");											//clear errors for all specific inputs
		$("#errList").text("");										//clear error list

		//<checking if max product price is in decimal format if it is entered>
		if(!(/(^[+|-]?\d*\.?\d*[0-9]+\d*$)|(^[+|-]?[0-9]+\d*\.\d*$)/.test(maxPrice)) && maxPrice != ""){
			maxPrice = "";
			$("#errList").append("Value for max price is not valid number!<br/>");
			$("#maxPErr").text("*");
		}
		//</checking if max product price is in decimal format if it is entered>

		//<checking if min product price is in decimal format if it is entered>
		if(!(/(^[+|-]?\d*\.?\d*[0-9]+\d*$)|(^[+|-]?[0-9]+\d*\.\d*$)/.test(minPrice)) && minPrice != ""){
			minPrice = "";
			$("#errList").append("Value for min price is not valid number!<br/>");
			$("#minPErr").text("*");
		}
		//</checking if min product price is in decimal format if it is entered>

		//<AJAX call for product search>
		$.ajax({
			url: "http://" + BASE_HREF + "product/search",
			type: "post",
			dataType: "json",
			data: {
				pagination: 0,
				name: name,
				maxPrice: maxPrice,
				minPrice: minPrice,
				cat: cat,
				discount: discount,
				stock: stock
			},
			//<on success display products we find>
			success: function(data, txt, xhr){	
				$("#main").html("");			//deleting all products
				let cnt = data.length;			//number of found products
				let app = "";					//html string to insert in #main after data is properly formed in html
				for(let i = 0; i< cnt; i++){
					//<begin new row of products>
					if(i%3 == 0){
						app = app + "<div class=\"row search-row\">";
					}
					//</begin new row of products>
					//<append product>
					app = app +
						"<div class=\"search-prod col-sm-4\">" +
							//<product image>
							"<div class=\" text-center\">" +
								"<img src=\"assets/images/" + data[i]["img"] + "\" width=\"auto\" height=\"150\"/>" +
							"</div>" +
							//</product image>
							"<div class=\"row search-details\">" +
								//<product name>
								"<div class=\"col-sm-9 text-center\">" +
									"<h6>" + data[i]["name"] + "</h6>" +		
								"</div>" +
								//</product name>
								//<product price>
								"<div class=\"col-sm-3 text-center\">" +
									"<h6 class=\"search-price\">" +
										"$" + parseFloat(Math.round(data[i]["unit_price"] * 100) / 100).toFixed(2) + 
									"</h6>" +
								"</div>" +
								//</product price>
							"</div>" +
							"<div class=\"row text-center product-links\">" +
								//<product details>
								"<div class=\"col-sm-6\">" +
									"<a href=\"prod.php?pid=" + data[i]["id"] + "\" class=\"search-detail\">Details</a>" +
								"</div>" +
								//</product details>
								//<buy product>
								"<div class=\"col-sm-6\">" +
									"<a href=\"\" class=\"product-action\" data-pid=\"" +  data[i]["id"] +
									 "\" data-cat=\"" +  data[i]["cat_id"] + "\">Purchase</a>" +
								"</div>" +	
								//</buy product>
							"</div>" +
						"</div>";
					//</append product>
					//<end row of products for every 3rd product or for last product>
					if(i % 3 == 2 || i + 1 == cnt){
						app = app + "</div>";
					}
					//</end row of products for every 3rd product or for last product>
				}
				$("#main").html(app);		//append formed html string from products
			},
			//</on success display products we find>
			//<on error alert>
			error: function(xhr, status, error){
				alert(xhr.status);	
			}
			//</on error alert>
		});
		//</AJAX call for product search>
	});
	//</Searching products on product-list page with AJAX>

	$("#pagination").on("click", ".product-pagination", function(e){
		e.preventDefault();
		console.log($(this).data("pag"));
	});

	//<Searching orders on order-list page with AJAX>
	$("#btnSearchOrders").click(function(){
		let customer = $("#tbCustomer").val();		//customer name
		let maxF = $("#tbMaxFreight").val();		//max order freight
		let minF = $("#tbMinFreight").val();		//min order freight
		let city = $("#tbCity").val();				//city to deliver
		let country = $("#tbCountry").val();		//country to deliver
		let address = $("#tbAddress").val();		//address to deliver
		let orderDate = $("#tbOrderDate").val();	//date to deliver

		$(".err").text("");							//clear errors for all specific inputs
		$("#errList").text("");						//clear error list

		//<checking if max freight is in decimal format if it is entered>
		if(!(/(^[+|-]?\d*\.?\d*[0-9]+\d*$)|(^[+|-]?[0-9]+\d*\.\d*$)/.test(maxF)) && maxF != ""){
			maxF = "";
			$("#errList").append("Value for max freight is not valid number!<br/>");
			$("#maxfErr").text("*");
		}
		//</checking if max freight is in decimal format if it is entered>

		//<checking if min freight is in decimal format if it is entered>
		if(!(/(^[+|-]?\d*\.?\d*[0-9]+\d*$)|(^[+|-]?[0-9]+\d*\.\d*$)/.test(minF)) && minF != ""){
			minF = "";
			$("#errList").append("Value for min freight is not valid number!<br/>");
			$("#minfErr").text("*");
		}
		//</checking if min freight is in decimal format if it is entered>

		//<checking if order date is in valid format if it is entered>
		if(!(/(0[1-9]|[1-2][0-9]|3[0-1])\.(0[1-9]|1[0-2])\.(19[0-9][0-9]|20[0-5][0-9])/.test(orderDate)) && orderDate != ""){
			orderDate = "";
			$("#errList").append("Order date is not in valid format, must be written like dd.mm.yyyy from 1900 to 2050!<br/>");
			$("#orderDateErr").text("*");
		}
		//</checking if order date is in valid format if it is entered>

		//<AJAX call for order search>
		$.ajax({
			url: "http://" + BASE_HREF + "order/search",
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
			//<on success display orders we find>
			success: function(data, txt, xhr){
				$("#orderTable").find("tr:gt(0)").remove();						//remove all rows except header row
				let cnt = data.length;											//number of orders found
				for(let i = 0; i < cnt; i++){
				//<append order into order table>
				$('#orderTable > tbody:last-child')
					.append(
						'<tr>' + 
							'<td>' + data[i]["id"] + '</td>' + 													//order id
							'<td>' + data[i]["username"] + '</td>' + 											//customer name
							'<td>' + data[i]["order_date"].substring(8, 10) + 									//order date
								'.' + data[i]["order_date"].substring(5, 7) + 
								'.' + data[i]["order_date"].substring(0, 4) + 
							'</td>' +
							'<td>' + data[i]["freight"] + '</td>' +												//order freight
							'<td>' + data[i]["address"] + '</td>' + 											//address to deliver
							'<td>' + data[i]["city"] + '</td>' +												//country to deliver
							'<td>' + 
								'<a href=\"http://' + BASE_HREF + 'order/' + data[i]["id"] + '\">Details</a>' +	//order details page
							'</td>' +
						'</tr>');
				//</append order into order table>
				}
			},
			//</on success display orders we find>
			//<on error alert>
			error: function(xhr, status, error){
				alert(xhr.status);	
			}
			//</on error alert>
		});
		//</AJAX call for order search>
	});
	//</Searching orders on order-list page with AJAX>

	//<Searching tickets on ticket-list page with AJAX>
	$("#btnSearchTickets").click(function(){
		let id = $("#tbID").val();					//ticket id
		let date = $("#tbTicketDate").val();		//ticket creation date
		let customer = $("#tbCustomer").val();		//user who created ticket

		$(".err").text("");							//clear errors for all specific inputs
		$("#errList").text("");						//clear error list

		//<checking if ticket creation date is in valid format if it is entered>
		if(!(/(0[1-9]|[1-2][0-9]|3[0-1])\.(0[1-9]|1[0-2])\.(19[0-9][0-9]|20[0-5][0-9])/.test(date)) && date != ""){
			date = "";
			$("#errList").append("Order date is not in valid format, must be written like dd.mm.yyyy from 1900 to 2050!<br/>");
			$("#ticketDateErr").text("*");
		}
		//</checking if ticket creation date is in valid format if it is entered>

		//<AJAX call for ticket search>
		$.ajax({
			url: "http://" + BASE_HREF + "ticket/search",
			type: "post",
			dataType: "json",
			data: {
				id: id,
				date: date,
				customer: customer
			},
			//<on success display found tickets>
			success: function(data, txt, xhr){
				$("#ticketTable").find("tr:gt(0)").remove();
				let cnt = data.length;
				for(let i = 0; i < cnt; i++){
				$('#ticketTable > tbody:last-child')
					.append(
						'<tr>' + 
							'<td>' + data[i]["id"] + '</td>' + 															//ticket id
							'<td>' + data[i]["username"] + '</td>' + 													//username
							'<td>' + data[i]["date"].substring(8, 10) + 												//ticket creation date
								'.' + data[i]["date"].substring(5, 7) + 
								'.' + data[i]["date"].substring(0, 4) + 
							'</td>' +
							'<td>' + data[i]["request"] + '</td>' +														//text
							'<td>' + 
								'<a href=\"#\ class=\"solve-ticket\" data-id=\"' + data[i]["id"] + '>Solved</a>' +		//solve ticket
								'<a href=\"#\ class=\"dismiss-ticket\" data-id=\"' + data[i]["id"] + '>Dismiss</a>' +	//dismiss ticket
							 '</td>' + 
						'</tr>');
				}
			},
			//</on success display found tickets>
			//<on status 404 == nothing found>
			error: function(xhr, status, error){
				if(xhr.status == 404){
					$("#errList").append("Nothing found<br/>");
				}
			}
			//</on status 404 == nothing found>
		});
		//</AJAX call for ticket search>
	});
	//</Searching tickets on ticket-list page with AJAX>

	$("#ticketTable").on("click", ".solve-ticket", function(e){
		let tid = $(this).data("id");
		$.ajax({
			url: "http://" + BASE_HREF + "/ticket/solve",
			type: "post",
			dataType: "json",
			data: {
				id: tid
			},
			success: function(data, txt, xhr){
				if(xhr.status == 200){

					let id = $("#tbID").val();
					let date = $("#tbTicketDate").val();
					let customer = $("#tbCustomer").val();

					$.ajax({
						url: "http://" + BASE_HREF + "ticket/search",
						type: "post",
						dataType: "json",
						data: {
							id: id,
							date: date,
							customer: customer
						},
						success: function(data, txt, xhr){
							$("#ticketTable").find("tr:gt(0)").remove();
							let cnt = data.length;
							for(let i = 0; i < cnt; i++){
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
											'<a href=\"#\" class=\"dismiss-ticket\" data-id=\"' + data[i]["id"] + '\">Dismiss</a>' +
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
		let tid = $(this).data("id");
		$.ajax({
			url: "http://" + BASE_HREF + "ticket/dismiss",
			type: "post",
			dataType: "json",
			data: {
				id: tid
			},
			success: function(data, txt, xhr){
				if(xhr.status == 200){

					let id = $("#tbID").val();
					let date = $("#tbTicketDate").val();
					let customer = $("#tbCustomer").val();

					$.ajax({
						url: "http://" + BASE_HREF + "ticket/search",
						type: "post",
						dataType: "json",
						data: {
							id: id,
							date: date,
							customer: customer
						},
						success: function(data, txt, xhr){
							$("#ticketTable").find("tr:gt(0)").remove();
							let cnt = data.length;
							for(let i = 0; i < cnt; i++){
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
											'<a href=\"#\" class=\"solve-ticket\" data-id=\"' + data[i]["id"] + '\"">Solved</a><br/>' +
											'<a href=\"#\" class=\"dismiss-ticket\" data-id=\"' + data[i]["id"] + '\"">Dismiss</a>' +
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
		let row = $(this).parent().parent();
		let name = row.find(".cat-name").text();
		let desc = row.find(".cat-desc").text();
		let id = $(this).data("id");
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
		let val = $(this).val();
		let name = $("#tbName").val();
		let desc = $("#txtDesc").val();
		alert(val);
		if(val == "Insert"){
			$.ajax({
				url: "http://" + BASE_HREF + "category/insert",
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
			let id = $("#catID").val();

			$.ajax({
				url: "http://" + BASE_HREF + "category/update",
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
		let name = $("#tbName").val();
		name = name.toLowerCase();
		let desc = $("#txtDesc").val();
		desc = desc.toLowerCase();

		$.ajax({
				url: "http://" + BASE_HREF + "category/search",
				type: "post",
				dataType: "json",
				data: {
					name: name,
					desc: desc
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

	//<Searching users on user-list page with AJAX>
	$("#btnSearchUsers").click(function(){
		let user = $("#tbCustomer").val();						//username
		let fn = $("#tbFn").val();								//users first name
		let ln = $("#tbLn").val();								//users last name
		let mail = $("#tbMail").val();							//users e-mail
		let status = $("#ddlStatus option:selected").val();		//users status

		//<AJAX call for user search>
		$.ajax({
				url: "http://" + BASE_HREF + "user/search",
				type: "post",
				dataType: "json",
				data: {
					user: user,
					fn: fn,
					ln: ln,
					mail: mail,
					status: status
				},
				//<status 200 = there are users found>
				success: function(data, txt, xhr){
					if(xhr.status == 200){
						$("#userTable").find("tr:gt(0)").remove();			//remove all table rows but first
						let cnt = data.length;								//number of users found
						for(let i = 0; i < cnt; i++){
							let status = "";								//user status
							//<user status in text>
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
							//</user status in text>
							//<append user to table of users>
							$('#userTable > tbody:last-child')
								.append(
									'<tr>' + 
										'<td class=\"cat-name\">' + data[i]["username"] + '</td>' + 						//display username
										'<td class=\"cat-desc\">' + data[i]["firstname"] + '</td>' + 						//display user first name
										'<td class=\"cat-desc\">' + data[i]["lastname"] + '</td>' +							//display user last name
										'<td class=\"cat-desc\">' + data[i]["email"] + '</td>' +							//display user e-mail
										'<td class=\"cat-desc\">' + status + '</td>' +										//display user status
										'<td>' + 
											'<a href=\"http://' + BASE_HREF + 'user/' + data[i]["id"] + '\">Profile</a>' +	//link to user profile
										 '</td>' + 
									'</tr>');
							//</append user to table of users>
						}
					}
				},
				//</status 200 = there are users found>
				//<status 404 = there are no users found>
				error: function(xhr, status, error){
					if(xhr.status == 404){
						$("#userTable").find("tr:gt(0)").remove();
					}
				}
				//</status 404 = there are no users found>
			});
	});
	//</Searching users on user-list page with AJAX>

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
			url: "http://" + BASE_HREF + "order/add",
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
					let cnt = data == null ? 0 : data.length;
					let items = "";
					if(cnt > 0){
						for(let i = 0; i < cnt; i++){
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
							"<li class=\"text-center\"><a href=\"http://" + BASE_HREF + "order-complete\">Complete order</a>");
					}else{
						$(".dropdown-menu").html("");
						$(".dropdown-menu").append("<li>&nbsp;&nbsp;&nbsp;No products selected</li>");
					}
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