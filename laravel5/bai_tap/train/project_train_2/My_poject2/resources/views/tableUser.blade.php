
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style type="text/css">
		
		.top {
		    position: relative;
		}

		div#example_filter {
		    position: absolute;
		    left: 300px;
		    top: -35px;
		}
		div#example_paginate {  /*paginate*/
		    margin-top: -50px;
		    margin-bottom: 32px;
		}
		.gara{
			border:none;
		}
		tr:nth-child(odd) .gara{
			background-color:#f9f9f9; 
		}
		div.dataTables_wrapper {
        width: 1340px;
        
    	}
	</style>
</head>
<body>
<div class="container-fluid">
	<form action="{!!route('getlist') !!}" method="post">
		<div class="row mt-5">

				<div class="col-md-5">
					
					<button type="button" class="btn btn-success pl-5 pr-5">Delete</button>
				</div>
				<div class="col-md-3">
					<button type="button" class="btn btn-warning pl-5 pr-5 float-right">Import</button>
				</div>
		</div>

		<div class="row margin">
			<div class="col">
				<table id="example" class="display" width="100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]">
			        <thead>
			            <tr>
			            	<th></th>
			                <th>Name</th>
			                <th>Id user</th>
			                <th>Gender</th>
			                <th>Position</th>
			                <th>Office</th>
			                <th>Age</th>
			                <th data-orderable="false">Start date</th>
			                <th>Salary</th>
			                <th>ID bike</th>
			                <th>Type</th>
			                
			            </tr>
			        </thead>
			        <tbody>
			            <tr>
			            	<td><input type="checkbox"></td>
			                <td>Tiger Nixon</td>
			                <td>M01</td>
			                <td>1</td>
			                <td>System Architect</td>
			                <td>Edinburgh</td>
			                <td>61</td>
			                <td>2011/04/25</td>
			                <td>$320,800</td>
			                <td>1A8</td>
			                <td>student</td>
			                <td>
			                	<select name="gara" class="gara">
									<option >A Area</option>
									<option>B Area</option>
									<option>C Area</option>
									<option>D Area</option>
								</select>

			                </td>
			            </tr>
			            <tr>
			            	<td><input type="checkbox"></td>
			                <td>Garrett Winters</td>
			                <td>M02</td>
			                <td>1</td>
			                <td>Accountant</td>
			                <td>Tokyo</td>
			                <td>63</td>
			                <td>2011/07/25</td>
			                <td>$170,750</td>
			                <td>1A2</td>
			                <td>worker</td>
			                <td>
			                	<select name="gara" class="gara">
									<option >A Area</option>
									<option>B Area</option>
									<option>C Area</option>
									<option>D Area</option>
								</select>

			                </td>
			            </tr>
			            <tr>
			            	<td><input type="checkbox"></td>
			                <td>Ashton Cox</td>
			                <td>M03</td>
			                <td>0</td>
			                <td>Junior Technical Author</td>
			                <td>San Francisco</td>
			                <td>66</td>
			                <td>2009/01/12</td>
			                <td>$86,000</td>
			                <td>1A3</td>
			                <td>student</td>
			                <td>
			                	<select name="gara" class="gara">
									<option >A Area</option>
									<option>B Area</option>
									<option>C Area</option>
									<option>D Area</option>
								</select>

			                </td>
			            </tr>
			            <tr>
			            	<td><input type="checkbox"></td>
			                <td>Cedric Kelly</td>
			                <td>M04</td>
			                <td>1</td>
			                <td>Senior Javascript Developer</td>
			                <td>Edinburgh</td>
			                <td>22</td>
			                <td>2012/03/29</td>
			                <td>$433,060</td>
			                <td>1A4</td>
			                <td>doctor</td>
			                <td>
			                	<select name="gara" class="gara">
									<option >A Area</option>
									<option>B Area</option>
									<option>C Area</option>
									<option>D Area</option>
								</select>

			                </td>
			            </tr>
			            <tr>
			            	<td><input type="checkbox"></td>
			                <td>Airi Satou</td>
			                <td>M05</td>
			                <td>1</td>
			                <td>Accountant</td>
			                <td>Tokyo</td>
			                <td>33</td>
			                <td>2008/11/28</td>
			                <td>$162,700</td>
			                <td>1A5</td>
			                <td>pet</td>
			                <td>
			                	<select name="gara" class="gara">
									<option >A Area</option>
									<option>B Area</option>
									<option>C Area</option>
									<option>D Area</option>
								</select>

			                </td>
			            </tr>
			            <tr>
			            	<td><input type="checkbox"></td>
			                <td>Brielle Williamson</td>
			                <td>M06</td>
			                <td>0</td>
			                <td>Integration Specialist</td>
			                <td>New York</td>
			                <td>61</td>
			                <td>2012/12/02</td>
			                <td>$372,000</td>
			                <td>1A6</td>
			                <td>student</td>
			                <td>
			                	<select name="gara" class="gara">
									<option >A Area</option>
									<option>B Area</option>
									<option>C Area</option>
									<option>D Area</option>
								</select>

			                </td>
			            </tr>
			            <tr>
			            	<td><input type="checkbox"></td>
			                <td>Herrod Chandler</td>
			                <td>M07</td>
			                <td>1</td>
			                <td>Sales Assistant</td>
			                <td>San Francisco</td>
			                <td>59</td>
			                <td>2012/08/06</td>
			                <td>$137,500</td>
			                <td>1A7</td>
			                <td>worker</td>
			                <td>
			                	<select name="gara" class="gara">
									<option >A Area</option>
									<option>B Area</option>
									<option>C Area</option>
									<option>D Area</option>
								</select>

			                </td>
			            </tr>
			            <tr>
			            	<td><input type="checkbox"></td>
			                <td>Rhona Davidson</td>
			                <td>M08</td>
			                <td>0</td>
			                
			                <td>Integration Specialist</td>
			                <td>Tokyo</td>
			                <td>55</td>
			                <td>2010/10/14</td>
			                <td>$327,900</td>
			                <td>1A9</td>
			                <td>student</td>
			                <td>
			                	<select name="gara" class="gara">
									<option >A Area</option>
									<option>B Area</option>
									<option>C Area</option>
									<option>D Area</option>
								</select>

			                </td>
			            </tr>
			            <tr>
			            	<td><input type="checkbox"></td>
			                <td>Colleen Hurst</td>
			                <td>M09</td>
			                <td>1</td>
			                <td>Javascript Developer</td>
			                <td>San Francisco</td>
			                <td>39</td>
			                <td>2009/09/15</td>
			                <td>$205,500</td>
			                <td>1A1</td>
			                <td>pet</td>
			                <td>
			                	<select name="gara" class="gara">
									<option >A Area</option>
									<option>B Area</option>
									<option>C Area</option>
									<option>D Area</option>
								</select>

			                </td>
			            </tr>
			            
			        </tbody>
			    </table>
			</div>
		</div>
		{{csrf_field()}}
	</form>
</div>

	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>