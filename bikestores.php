<?php
	
	header("Access-Control-Allow-Origin: *");	
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
    header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,X-Requested-With");
    
	require_once __DIR__.'/bootstrap.php';

	use Entity\Brands;
	use Entity\Categories;
	use Entity\Employees;
	use Entity\Products;
	use Entity\Stores;
	use Entity\Stocks;

	use Repository\BrandsRepository;
	use Repository\CategoriesRepository;
	use Repository\StoresRepository;
	use Repository\ProductsRepository;
	use Repository\EmployeesRepository;
	use Entity\StocksRepository;

	$request_method=$_SERVER["REQUEST_METHOD"];
	switch($request_method){
		case "GET":			
			if(!empty($_REQUEST["action"])) {
				switch($_REQUEST["action"]){

					# BRANDS -------------------------------------------------------
					case "getBrandsList":
						$myBrandsRepository = $entityManager->getRepository(Brands::Class);
						if($_REQUEST["sort_column"]=='brand_id'
							|| $_REQUEST["sort_column"]=='brand_name'){
								$allBrands = $myBrandsRepository->getAllWithSort($_REQUEST["sort_column"],$_REQUEST["sort_order"]);
						} else {
							$allBrands = $myBrandsRepository->findAll();
						}
						$output = '{ "brands" : [';
						if($allBrands!=NULL) {
							$length = count($allBrands);
							for ($i = 0 ; $i < $length-1 ; $i++) {
								$output .= json_encode($allBrands[$i]) . ",";
							}
							$output .= json_encode($allBrands[$length-1]) ;
							echo $output . "]}";
						} else {
							$response=array("status" => 0,"status_message" =>'List of all brands not found.');
							echo json_encode($response);
						}
						break;
					case "getBrandById":
						$brand = $entityManager->find(Brands::Class,$_REQUEST["id"]);
						if($brand!=NULL) {
							echo json_encode($brand) ;
						} else {
							$response=array("status" => 0,"status_message" =>'This brand id not found.');
							echo json_encode($response);
						}
						break;
					case "getBrandDetail":
						$myBrandsRepository = $entityManager->getRepository(Brands::Class);
						$brand = $entityManager->find(Brands::Class,$_REQUEST["id"]);
						if($brand!=NULL) {
							if($_REQUEST["detail"]=='brand_name'){
								$brandDetail = $myBrandsRepository->getBrandDetail($_REQUEST["id"]);
								echo json_encode($brandDetail);
							} else {
								$response=array("status" => 0,"status_message" =>'This brand attribute does not exist.');
								echo json_encode($response);
							}
						} else {
							$response=array("status" => 0,"status_message" =>'This brand id not found.');
							echo json_encode($response);
						}
						break;

					# CATEGORIES -------------------------------------------------------
					case "getCategoriesList":
						$myCategoriesRepository = $entityManager->getRepository(Categories::Class);
						if($_REQUEST["sort_column"]=='category_id'
							|| $_REQUEST["sort_column"]=='category_name'){
								$allCategories = $myCategoriesRepository->getAllWithSort($_REQUEST["sort_column"],$_REQUEST["sort_order"]);
						} else {
							$allCategories = $myCategoriesRepository->findAll();
						}
						$output = '{ "categories" : [';
						if($allCategories!=NULL) {
							$length = count($allCategories);
							for ($i = 0 ; $i < $length-1 ; $i++) {
								$output .= json_encode($allCategories[$i]) . ",";
							}
							$output .= json_encode($allCategories[$length-1]) ;
							echo $output . "]}";
						} else {
							$response=array("status" => 0,"status_message" =>'List of all categories not found.');
							echo json_encode($response);
						}
						break;
					case "getCategoryById":
						$category = $entityManager->find(Categories::Class,$_REQUEST["id"]);
						if($category!=NULL) {
							echo json_encode($category) ;
						} else {
							$response=array("status" => 0,"status_message" =>'This category id not found.');
							echo json_encode($response);
						}
						break;
					case "getCategoryDetail":
						$myCategoriesRepository = $entityManager->getRepository(Categories::Class);
						$category = $entityManager->find(Categories::Class,$_REQUEST["id"]);
						if($category!=NULL) {
							if($_REQUEST["detail"]=='category_name'){
								$categoryDetail = $myCategoriesRepository->getCategoryDetail($_REQUEST["id"]);
								echo json_encode($categoryDetail);
							} else {
								$response=array("status" => 0,"status_message" =>'This category attribute does not exist.');
								echo json_encode($response);
							}
						} else {
							$response=array("status" => 0,"status_message" =>'This category id not found.');
							echo json_encode($response);
						}
						break;

					# STORES -------------------------------------------------------
					case "getStoresList":
						$myStoresRepository = $entityManager->getRepository(Stores::Class);
						if($_REQUEST["sort_column"]=='store_id'
							|| $_REQUEST["sort_column"]=='store_name'
							|| $_REQUEST["sort_column"]=='phone'
							|| $_REQUEST["sort_column"]=='email'
							|| $_REQUEST["sort_column"]=='street'
							|| $_REQUEST["sort_column"]=='city'
							|| $_REQUEST["sort_column"]=='state'
							|| $_REQUEST["sort_column"]=='zip_code'){
								$allStores = $myStoresRepository->getAllWithSort($_REQUEST["sort_column"],$_REQUEST["sort_order"]);
						} else {
							$allStores = $myStoresRepository->findAll();
						}
						if($allStores!=NULL) {
							$output = '{ "stores" : [';
							if($allStores!=NULL) {
								$length = count($allStores);
								for ($i = 0 ; $i < $length-1 ; $i++) {
									$output .= json_encode($allStores[$i]) . ",";
								}
								$output .= json_encode($allStores[$length-1]) ;
								echo $output . "]}";
							} else {
								$response=array("status" => 0,"status_message" =>'List of all stores not found.');
								echo json_encode($response);
							}
						}
						break;
					case "getStoreById":
						$store = $entityManager->find(Stores::Class,$_REQUEST["id"]);
						if($store!=NULL) {
							echo json_encode($store);
						} else {
							$response=array("status" => 0,"status_message" =>'This store id not found.');
							echo json_encode($response);
						}
						break;
					case "getStoreDetail":
						$myStoresRepository = $entityManager->getRepository(Stores::Class);
						$store = $entityManager->find(Stores::Class,$_REQUEST["id"]);
						if($store!=NULL) {
							if($_REQUEST["detail"]=='store_name'
							|| $_REQUEST["detail"]=='phone'
							|| $_REQUEST["detail"]=='email'
							|| $_REQUEST["detail"]=='street'
							|| $_REQUEST["detail"]=='city'
							|| $_REQUEST["detail"]=='state'
							|| $_REQUEST["detail"]=='zip_code'){
								$storeDetail = $myStoresRepository->getStoreDetail($_REQUEST["id"],$_REQUEST["detail"]);
								echo json_encode($storeDetail);
							} else {
								$response=array("status" => 0,"status_message" =>'This store attribute does not exist.');
								echo json_encode($response);
							}
						} else {
							$response=array("status" => 0,"status_message" =>'This store id not found.');
							echo json_encode($response);
						}
						break;
						
					# PRODUCTS -------------------------------------------------------
					case "getProductsList":
						$myProductsRepository = $entityManager->getRepository(Products::Class);
						if($_REQUEST["sort_column"]=='product_id'
							|| $_REQUEST["sort_column"]=='product_name'
							|| $_REQUEST["sort_column"]=='brand'
							|| $_REQUEST["sort_column"]=='category'
							|| $_REQUEST["sort_column"]=='model_year'
							|| $_REQUEST["sort_column"]=='list_price'){
								$allProducts = $myProductsRepository->getAllWithSort($_REQUEST["sort_column"],$_REQUEST["sort_order"]);
						} else {
							$allProducts = $myProductsRepository->findAll();
						}
						if($allProducts!=NULL) {
							$output = '{ "products" : [';
								if($allProducts!=NULL) {
									$length = count($allProducts);
									for ($i = 0 ; $i < $length-1 ; $i++) {
										$output .= json_encode($allProducts[$i]) . ",";
									}
									$output .= json_encode($allProducts[$length-1]) ;
									echo $output . "]}";
								}
						} else {
							$response=array("status" => 0,"status_message" =>'List of all products not found.');
							echo json_encode($response);
						}
						break;
					case "getProductById":
						$product = $entityManager->find(Products::Class,$_REQUEST["id"]);
						if($product!=NULL) {
							echo json_encode($product) ;
						} else {
							$response=array("status" => 0,"status_message" =>'This product id not found.');
							echo json_encode($response);
						}
						break;
					case "getProductDetail":
						$myProductsRepository = $entityManager->getRepository(Products::Class);
						$product = $entityManager->find(Products::Class,$_REQUEST["id"]);
						if($product!=NULL) {
							if($_REQUEST["detail"]=='product_name'
							|| $_REQUEST["detail"]=='brand'
							|| $_REQUEST["detail"]=='category'
							|| $_REQUEST["detail"]=='model_year'
							|| $_REQUEST["detail"]=='list_price'){
								$productDetail = $myProductsRepository->getProductDetail($_REQUEST["id"],$_REQUEST["detail"]);
								echo json_encode($productDetail);
							} else {
								$response=array("status" => 0,"status_message" =>'This product attribute does not exist.');
								echo json_encode($response);
							}
						} else {
							$response=array("status" => 0,"status_message" =>'This product id not found.');
							echo json_encode($response);
						}
						break;
					case "getProductsByBrand":
						$myProductsRepository = $entityManager->getRepository(Products::Class);
						$myBrandsRepository = $entityManager->getRepository(Brands::Class);
						$brand = $myBrandsRepository->findBy(["brand_name"=>$_REQUEST["brand_name"]]);
						if($brand!=NULL) {
							$productFiltered = $myProductsRepository->findBy(['brand'=> $brand]);
							if($productFiltered!=NULL) {
								$output = '{ "products" : [';
									if($productFiltered!=NULL) {
										$length = count($productFiltered);
										for ($i = 0 ; $i < $length-1 ; $i++) {
											$output .= json_encode($productFiltered[$i]) . ",";
										}
										$output .= json_encode($productFiltered[$length-1]) ;
										echo $output . "]}";
									}
							} else {
								$response=array("status" => 0,"status_message" =>'Filtering by brand failed.');
								echo json_encode($response);
							}
						} else {
							$response=array("status" => 0,"status_message" =>'Failure of request.');
							echo json_encode($response);
						}
						break;
					case "getProductsByCategory":
						$myProductsRepository = $entityManager->getRepository(Products::Class);
						$myCategoriesRepository = $entityManager->getRepository(Categories::Class);
						$category = $myCategoriesRepository->findBy(["category_name"=>$_REQUEST["category_name"]]);
						if($category!=NULL) {
							$productFiltered = $myProductsRepository->findBy(['category' => $category]);
							if($productFiltered!=NULL) {
								$output = '{ "products" : [';
									if($productFiltered!=NULL) {
										$length = count($productFiltered);
										for ($i = 0 ; $i < $length-1 ; $i++) {
											$output .= json_encode($productFiltered[$i]) . ",";
										}
										$output .= json_encode($productFiltered[$length-1]) ;
										echo $output . "]}";
									}
							} else {
								$response=array("status" => 0,"status_message" =>'Filtering by category failed.');
								echo json_encode($response);
							}
						} else {
							$response=array("status" => 0,"status_message" =>'Failure of request.');
							echo json_encode($response);
						}
						break;
					case "getProductsByYear":
						$myProductsRepository = $entityManager->getRepository(Products::Class);
						$productFiltered = $myProductsRepository->findBy(['model_year' =>$_REQUEST["model_year"]]);
						if($productFiltered!=NULL) {
							$output = '{ "products" : [';
								if($productFiltered!=NULL) {
									$length = count($productFiltered);
									for ($i = 0 ; $i < $length-1 ; $i++) {
										$output .= json_encode($productFiltered[$i]) . ",";
									}
									$output .= json_encode($productFiltered[$length-1]) ;
									echo $output . "]}";
								}
						} else {
							$response=array("status" => 0,"status_message" =>'Filtering by year of release failed.');
							echo json_encode($response);
						}
						break;
					case "getProductsByPrices":
						$myProductsRepository = $entityManager->getRepository(Products::Class);
						$productFiltered = $myProductsRepository->findBetweenPrices($_REQUEST["min"], $_REQUEST["max"]);
						if($productFiltered!=NULL) {
							$output = '{ "products" : [';
								if($productFiltered!=NULL) {
									$length = count($productFiltered);
									for ($i = 0 ; $i < $length-1 ; $i++) {
										$output .= json_encode($productFiltered[$i]) . ",";
									}
									$output .= json_encode($productFiltered[$length-1]) ;
									echo $output . "]}";
								}
						} else {
							$response=array("status" => 0,"status_message" =>'Filtering by these prices failed.');
							echo json_encode($response);
						}
						break;
					case "getProductsFiltered":
						$myProductsRepository = $entityManager->getRepository(Products::Class);
						$myBrandsRepository = $entityManager->getRepository(Brands::Class);
						$brand = $myBrandsRepository->findBy(["brand_name"=>$_REQUEST["brand_name"]]);
						$myCategorysRepository = $entityManager->getRepository(Categories::Class);
						$category = $myCategorysRepository->findBy(["category_name"=>$_REQUEST["category_name"]]);
						$productFiltered = $myProductsRepository->customFindBy($brand, $category,$_REQUEST["model_year"], $_REQUEST["min"], $_REQUEST["max"]);
						if($productFiltered!=NULL) {
							$output = '{ "products" : [';
								if($productFiltered!=NULL) {
									$length = count($productFiltered);
									for ($i = 0 ; $i < $length-1 ; $i++) {
										$output .= json_encode($productFiltered[$i]) . ",";
									}
									$output .= json_encode($productFiltered[$length-1]) ;
									echo $output . "]}";
								}
						} else {
							$response=array("status" => 0,"status_message" =>'Filtering by this combination of filters failed.');
							echo json_encode($response);
						}
						break;

					# EMPLOYEES -------------------------------------------------------
					case "getEmployeesList":
						$myEmployeesRepository = $entityManager->getRepository(Employees::Class);
						if($_REQUEST["sort_column"]=='employee_id'
							|| $_REQUEST["sort_column"]=='employee_name'
							|| $_REQUEST["sort_column"]=='employee_email'
							|| $_REQUEST["sort_column"]=='employee_role'){
								$allEmployees = $myEmployeesRepository->getAllWithSort($_REQUEST["sort_column"],$_REQUEST["sort_order"]);
						} else {
							$allEmployees = $myEmployeesRepository->findAll();
						}
						if($allEmployees!=NULL) {
							$output = '{ "employees" : [';
								if($allEmployees!=NULL) {
									$length = count($allEmployees);
									for ($i = 0 ; $i < $length-1 ; $i++) {
										$output .= json_encode($allEmployees[$i]) . ",";
									}
									$output .= json_encode($allEmployees[$length-1]) ;
									echo $output . "]}";
								}
						} else {
							$response=array("status" => 0,"status_message" =>'List of all employees not found.');
							echo json_encode($response);
						}
						break;
					case "getEmployeeById":
						$employee = $entityManager->find(Employees::Class,$_REQUEST["id"]);
						if($employee!=NULL) {
							echo json_encode($employee) ;
						} else {
							$response=array("status" => 0,"status_message" =>'This employee id not found.');
							echo json_encode($response);
						}
						break;
					case "getEmployeeCredentials":
						$myEmployeesRepository = $entityManager->getRepository(Employees::Class);
						if($_REQUEST["employee_email"] != null && $_REQUEST["employee_password"] != null){
							$employee = $myEmployeesRepository->findBy(['employee_email'=> $_REQUEST["employee_email"], 'employee_password'=> $_REQUEST["employee_password"]]);
							if($employee!=NULL) {
								echo json_encode($employee) ;
							} else {
								$response=array("status" => 0,"status_message" =>'This employee information are not found.');
								echo json_encode($response);
							}
						}
						break;
					case "getEmployeeDetail":
						$myEmployeesRepository = $entityManager->getRepository(Employees::Class);
						$employee = $entityManager->find(Employees::Class,$_REQUEST["id"]);
						if($employee!=NULL) {
							if($_REQUEST["detail"]=='store'
							|| $_REQUEST["detail"]=='employee_name'
							|| $_REQUEST["detail"]=='employee_email'
							|| $_REQUEST["detail"]=='employee_role'){
								$employeeDetail = $myEmployeesRepository->getEmployeeDetail($_REQUEST["id"],$_REQUEST["detail"]);
								echo json_encode($employeeDetail);
							} else {
								$response=array("status" => 0,"status_message" =>'This employee attribute does not exist.');
								echo json_encode($response);
							}
						} else {
							$response=array("status" => 0,"status_message" =>'This employee id not found.');
							echo json_encode($response);
						}
						break;
					case "getEmployeesByStore":
						$myEmployeesRepository = $entityManager->getRepository(Employees::Class);
						$myStoresRepository = $entityManager->getRepository(Stores::Class);
						$store = $myStoresRepository->findBy(["store_name"=>$_REQUEST["store_name"]]);
						if($store!=NULL) {
							$employeeFiltered = $myEmployeesRepository->findBy(['store' => $store]);
							if($employeeFiltered!=NULL) {
								echo json_encode($employeeFiltered);
							} else {
								$response=array("status" => 0,"status_message" =>'Filtering employees by store failed.');
								echo json_encode($response);
							}
						} else {
							$response=array("status" => 0,"status_message" =>'Failure of request.');
							echo json_encode($response);
						}
						break;
					case "getEmployeesByRole":
						$myEmployeesRepository = $entityManager->getRepository(Employees::Class);
						$employeeFiltered = $myEmployeesRepository->findBy(['employee_role' => $_REQUEST["employee_role"]]);
						if($employeeFiltered!=NULL) {
							echo json_encode($employeeFiltered);
						} else {
							$response=array("status" => 0,"status_message" =>'Filtering employees by role failed.');
							echo json_encode($response);
						}
						break;
					case "getEmployeesByStoreByRole":
						$myEmployeesRepository = $entityManager->getRepository(Employees::Class);
						$myStoresRepository = $entityManager->getRepository(Stores::Class);
						$store = $myStoresRepository->findBy(["store_name"=>$_REQUEST["store_name"]]);
						$employeeFiltered = $myEmployeesRepository->findBy(['store' => $store, 'employee_role' => $_REQUEST["employee_role"]]);
						if($employeeFiltered!=NULL) {
							echo json_encode($employeeFiltered);
						} else {
							$response=array("status" => 0,"status_message" =>'Failure of request.');
							echo json_encode($response);
						}
						break;

					# STOCKS -------------------------------------------------------
					case "getStocksList":
						$myStocksRepository = $entityManager->getRepository(Stocks::Class);
						if($_REQUEST["sort_column"]=='stock_id'
							|| $_REQUEST["sort_column"]=='store_name'
							|| $_REQUEST["sort_column"]=='product_name'
							|| $_REQUEST["sort_column"]=='quantity'){
								$allStocks = $myStocksRepository->getAllWithSort($_REQUEST["sort_column"],$_REQUEST["sort_order"]);
						} else {
							$allStocks = $myStocksRepository->findAll();
						}
						if($allStocks!=NULL) {
							foreach ($allStocks as $stock) {
								echo json_encode($stock) ;
							}
						} else {
							$response=array("status" => 0,"status_message" =>'List of all stocks not found.');
							echo json_encode($response);
						}
						break;
					case "getStockById":
						$stock = $entityManager->find(Stocks::Class,$_REQUEST["id"]);
						if($stock!=NULL) {
							echo json_encode($stock) ;
						} else {
							$response=array("status" => 0,"status_message" =>'This stock id not found.');
							echo json_encode($response);
						}
						break;
					case "getStockDetail":
						$myStocksRepository = $entityManager->getRepository(Stocks::Class);
						$stock = $entityManager->find(Stocks::Class,$_REQUEST["id"]);
						if($stock!=NULL) {
							if($_REQUEST["detail"]=='store_name'
							|| $_REQUEST["detail"]=='product_name'
							|| $_REQUEST["detail"]=='quantity'){
								$stockDetail = $myStocksRepository->getStockDetail($_REQUEST["id"],$_REQUEST["detail"]);
								echo json_encode($stockDetail);
							} else {
								$response=array("status" => 0,"status_message" =>'This stock attribute does not exist.');
								echo json_encode($response);
							}
						} else {
							$response=array("status" => 0,"status_message" =>'This stock id not found.');
							echo json_encode($response);
						}
						break;
					case "getStocksByProduct":
						$myStocksRepository = $entityManager->getRepository(Stocks::Class);
						$myProductsRepository = $entityManager->getRepository(Products::Class);
						$product = $myProductsRepository->findBy(['product_name' =>$_REQUEST["product_name"]]);
						if($product!=NULL) {
							$stockFiltered = $myStocksRepository->findBy(['product' => $product]);
							if($stockFiltered!=NULL) {
								echo json_encode($stockFiltered);
							} else {
								$response=array("status" => 0,"status_message" =>'Filtering stocks of this product failed.');
								echo json_encode($response);
							}
						} else {
							$response=array("status" => 0,"status_message" =>'Failure of request.');
							echo json_encode($response);
						}
						break;
					case "getStocksByStore":
						$myStocksRepository = $entityManager->getRepository(Stocks::Class);
						$myStoresRepository = $entityManager->getRepository(Stores::Class);
						$store = $myStoresRepository->findBy(['store_name' =>$_REQUEST["store_name"]]);
						if($store!=NULL) {
							$stockFiltered = $myStocksRepository->findBy(['store' => $store]);
							if($stockFiltered!=NULL) {
								echo json_encode($stockFiltered);
							} else {
								$response=array("status" => 0,"status_message" =>'Filtering stocks of this store failed.');
								echo json_encode($response);
							}
						} else {
							$response=array("status" => 0,"status_message" =>'Failure of request.');
							echo json_encode($response);
						}
						break;
					case "getStocksByProductByStore":
						$myStocksRepository = $entityManager->getRepository(Stocks::Class);
						$myProductsRepository = $entityManager->getRepository(Products::Class);
						$product = $myProductsRepository->findBy(['product_name' =>$_REQUEST["product_name"]]);
						$myStoresRepository = $entityManager->getRepository(Stores::Class);
						$store = $myStoresRepository->findBy(['store_name' =>$_REQUEST["store_name"]]);
						$stockFiltered = $myStocksRepository->findBy(['product' => $product, 'store' => $store]);
						if($stockFiltered!=NULL) {
							echo json_encode($stockFiltered);
						} else {
							$response=array("status" => 0,"status_message" =>'Failure of request.');
							echo json_encode($response);
						}
						break;	
			}
		}
		break;
							
		# -------------------------------------------------------------
		case "POST":			
			if(!empty($_REQUEST["action"])) {
				switch($_REQUEST["action"]){
					case "createBrand":
						$myBrandsRepository = $entityManager->getRepository(Brands::Class);
						if($_REQUEST["brand_name"]!=NULL) {
							$response=$myBrandsRepository->create($entityManager, $_REQUEST["brand_name"]);
						} else {
							$response=array("status" => 0,"status_message" =>'One attribute at least is null.');	
						}
						echo json_encode($response);
						break;
					case "createCategory":
						$myCategoriesRepository = $entityManager->getRepository(Categories::Class);
						if($_REQUEST["category_name"]!=NULL) {
							$response=$myCategoriesRepository->create($entityManager, $_REQUEST["category_name"]);
						} else {
							$response=array("status" => 0,"status_message" =>'One attribute at least is null.');	
						}
						echo json_encode($response);
						break;
					case "createStore":
						$myStoresRepository = $entityManager->getRepository(Stores::Class);
						if($_REQUEST["store_name"]!=NULL
							&& $_REQUEST["phone"]!=NULL
							&& $_REQUEST["email"]!=NULL
							&& $_REQUEST["street"]!=NULL
							&& $_REQUEST["city"]!=NULL
							&& $_REQUEST["state"]!=NULL
							&& $_REQUEST["zip_code"]!=NULL) {
							$response=$myStoresRepository->create($entityManager, $_REQUEST["store_name"],
							$_REQUEST["phone"],$_REQUEST["email"],$_REQUEST["street"],
							$_REQUEST["city"],$_REQUEST["state"], $_REQUEST["zip_code"]);
						} else {
							$response=array("status" => 0,"status_message" =>'One attribute at least is null.');	
						}
						echo json_encode($response);
						break;
				}
			}
			break;
		case "PUT":	
			if(!empty($_REQUEST["action"])) {
				switch($_REQUEST["action"]){
					case "updateBrand":
						$myBrandsRepository = $entityManager->getRepository(Brands::Class);
						$brand = $entityManager->find(Brands::Class,$_REQUEST["id"]);
						if($brand!=NULL) {
							if($_REQUEST["brand_name"]!=NULL) {
								$response=$myBrandsRepository->update($entityManager, $_REQUEST["brand_name"], $brand);
							} else {
								$response=array("status" => 0,"status_message" =>'One attribute at least is null.');	
							}
							echo json_encode($response);
						} else {
							$response=array("status" => 0,"status_message" =>'This brand id not found.');
							echo json_encode($response);
						}
						break;
					case "updateCategory":
						$myCategoriesRepository = $entityManager->getRepository(Categories::Class);
						$category = $entityManager->find(Categories::Class,$_REQUEST["id"]);
						if($category!=NULL) {
							if($_REQUEST["category_name"]!=NULL) {
								$response=$myCategoriesRepository->update($entityManager, $_REQUEST["category_name"], $category);
							} else {
								$response=array("status" => 0,"status_message" =>'One attribute at least is null.');	
							}
							echo json_encode($response);
						} else {
							$response=array("status" => 0,"status_message" =>'This category id not found.');
							echo json_encode($response);
						}
						break;
					case "updateStore":
						$myStoresRepository = $entityManager->getRepository(Stores::Class);
						$store = $entityManager->find(Stores::Class,$_REQUEST["id"]);
						if($store!=NULL) {
							if($_REQUEST["store_name"]!=NULL
							&& $_REQUEST["phone"]!=NULL
							&& $_REQUEST["email"]!=NULL
							&& $_REQUEST["street"]!=NULL
							&& $_REQUEST["city"]!=NULL
							&& $_REQUEST["state"]!=NULL
							&& $_REQUEST["zip_code"]!=NULL) {
								$response=$myStoresRepository->update($entityManager, $_REQUEST["store_name"],
								$_REQUEST["phone"],$_REQUEST["email"],$_REQUEST["street"],
								$_REQUEST["city"],$_REQUEST["state"], $_REQUEST["zip_code"], $store);							
							} else {
								$response=array("status" => 0,"status_message" =>'One attribute at least is null.');	
							}
							echo json_encode($response);
						} else {
							$response=array("status" => 0,"status_message" =>'This store id not found.');
							echo json_encode($response);
						}
						break;
					case "updateEmployee":
						$myEmployeesRepository = $entityManager->getRepository(Employees::Class);
						$employee = $entityManager->find(Employees::Class,$_REQUEST["id"]);
						if($employee!=NULL) {
							if($_REQUEST["employee_name"]!=NULL
									&& $_REQUEST["employee_email"]!=NULL
									&& $_REQUEST["employee_password"]!=NULL) {
								$response=$myEmployeesRepository->update($entityManager, $_REQUEST["employee_name"],$_REQUEST["employee_email"],$_REQUEST["employee_password"], $employee);
							} else {
								$response=array("status" => 0,"status_message" =>'One attribute at least is null.');	
							}
							echo json_encode($response);
						} else {
							$response=array("status" => 0,"status_message" =>'This employee id not found.');
							echo json_encode($response);
						}
						break;
				}
			}
			break;
		case "DELETE":			
			if(!empty($_REQUEST["action"])) {
				switch($_REQUEST["action"]){
					case "deleteBrand":
						$myBrandsRepository = $entityManager->getRepository(Brands::Class);
						$brand = $myBrandsRepository->find($_REQUEST["id"]);
						if($brand!=NULL) {
							$entityManager->remove($brand);
							$entityManager->flush($brand);
							$response=array("status" => 0,"status_message" =>'Successful request,  deletion done.');
							echo json_encode($response);
						} else {
							$response=array("status" => 0,"status_message" =>'This brand id not found.');
							echo json_encode($response);
						}
						break;
					case "deleteCategory":
						$myCategoriesRepository = $entityManager->getRepository(Categories::Class);
						$category = $myCategoriesRepository->find($_REQUEST["id"]);
						if($category!=NULL) {
							$entityManager->remove($category);
							$entityManager->flush($category);
							$response=array("status" => 0,"status_message" =>'Successful request, deletion done.');
							echo json_encode($response);
						} else {
							$response=array("status" => 0,"status_message" =>'This category id not found.');
							echo json_encode($response);
						}
						break;
					case "deleteStore":
						$myStoresRepository = $entityManager->getRepository(Stores::Class);
						$store = $myStoresRepository->find($_REQUEST["id"]);
						if($store!=NULL) {
							$entityManager->remove($store);
							$entityManager->flush($store);
							$response=array("status" => 0,"status_message" =>'Successful request, deletion done.');
							echo json_encode($response);
						} else {
							$response=array("status" => 0,"status_message" =>'This store id not found.');
							echo json_encode($response);
						}
						break;

				}
			}
			break;
	}

?>