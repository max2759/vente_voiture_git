<?php


class cars extends model
{
    var $table = 'cars c';
    var $data;

    function displayCarousel($cars){

        for($i = 0; $i<3; $i++)
        {
            echo '<div class="col-md-4">
                            <div class="card mb-2">
                                <img class="card-img-top" src="../VIEW/img/'.$cars->data[$i]->picture.'"
                                     alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title">'.$cars->data[$i]->model.'</h4>
                                    <p class="card-text">
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><i class="fas fa-euro-sign"></i></i> '.number_format($cars->data[$i]->unitprice, 2, ',', ' ').'</li>
                                    <li class="list-group-item"><i class="fas fa-road"></i></i> '.number_format($cars->data[$i]->kilometer, 2, ',', ' ').' Km</li>
                                    <li class="list-group-item"><i class="fas fa-gas-pump"></i> ' . $cars->data[$i]->fuel . '</li>
                                    </ul>
                                        </p>
                                    <a href="../CONTROL/cars.php" class="btn btn-warning"><i class="far fa-eye"></i></a>
                                </div>
                            </div>
                        </div>';
        };

    }

    function displayCardCars($cars)
    {
        foreach ($cars->data as $k) {
            echo '<div class="card">';

            if($k->picture == NULL){
                echo '<img class="card-img-top" src="../VIEW/img/no-image-icon.png" alt="Card image cap" height="238,49px">';
            }else{
                echo '<img class="card-img-top" src="../VIEW/img/'.$k->picture.'" alt="Card image cap">';
                }

            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $k->model . '</h5>';
            echo '<p class="card-text">' . $k->name . '</p>';
            if ($k->isActive == 1) {
                echo '<i class="fas fa-check"></i><span class="car-available"> Disponible</span>';
            } else {
                echo '<i class="fas fa-times"></i><span class="car-unavailable"> Vendue</span>';
            }
            echo '</div>';
            echo '<ul class="list-group list-group-flush">';
            echo  '<li class="list-group-item"><i class="fas fa-euro-sign"></i></i> ' . number_format($k->unitprice, 2, ',', ' ') . '</li>';
            echo  '<li class="list-group-item"><i class="fas fa-road"></i> ' . number_format($k->kilometer, 2, ',', ' ') . ' km</li>';
            echo '<li class="list-group-item"><i class="fas fa-tachometer-alt"></i> ' . $k->horsepower . ' CH</li>';
            echo '<li class="list-group-item"><i class="fas fa-calendar-alt"></i> ' . $k->year . '</li>';
            echo '<li class="list-group-item"><i class="fas fa-palette"></i> ' . $k->color . '</li>';
            echo '<li class="list-group-item"><i class="fas fa-gas-pump"></i> ' . $k->fuel . '</li>';
            echo '</ul>';
            echo '<div class="card-body">';
            if($k->isActive == 1){
                echo '<td><button type="button" class="btn btn-warning btn-xl add_to_cart" id="'.$k->cars_ID.'"><i class="fas fa-cart-arrow-down"></i> Ajouter au panier</button></td>';
            }else{
                echo '<td><button type="button" class="btn btn-warning btn-xl add_to_cart" id="'.$k->cars_ID.'" disabled><i class="fas fa-cart-arrow-down"></i> Ajouter au panier</button></td>';
            }
            echo '</div>
        </div>';
        }
    }

    function displayCarstoShop($cars){
        foreach($cars as $k){
           echo '<!-- PRODUCT -->
                <div class="row">               
                    <div class="col-12 col-sm-12 col-md-2 text-center">
                        <img class="img-responsive" src="../VIEW/img/'.$k->picture.'" alt="prewiew" width="120" height="80">
                    </div>
                    <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                        <h4 class="product-name"><strong>'.$k->name.'</strong></h4>
                        <h4>
                            <small>'.$k->model.'</small>
                        </h4>
                    </div>
                    <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                        <div class="col-4 col-sm-10 col-md-25 text-md-right fp" style="padding-top: 5px">
                        <span class="input-symbol-euro">
                        <input type="number" name="finalPrice" class="finalPrice" value="'.$k->unitprice.'" step="100">
                        </span>
                        </div>
                        <!--<div class="col-4 col-sm-4 col-md-4">
                            <div class="quantity">                             
                                <input type="number" step="1" max="1" min="1" value="1" title="Qty" class="qty"
                                       size="4">                            
                            </div>
                        </div>-->
                        <div class="col-2 col-sm-2 col-md-2 text-right">
                            <button type="button" class="btn btn-outline-danger btn-xs del-cars" id="'.$k->cars_ID.'">
                                <i class="fa fa-trash" aria-hidden="true"></i>                         
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- END PRODUCT -->';
        }
    }

    function addCar($brandsID, $model, $color, $km ,$fuel, $horsepower, $unitPrice,$year, $picture){
        $req= $this->stmt->prepare('CALL addCar(:pBrandsId,:pModel,:pColor,:pKm, :pFuel, :pHorsepower, :pUnitprice, :pYear, :pPicture)');
        $req->bindParam(":pBrandsId", $brandsID, PDO::PARAM_INT);
        $req->bindParam(":pModel", $model, PDO::PARAM_STR, 255);
        $req->bindParam(":pColor", $color, PDO::PARAM_STR, 255);
        $req->bindParam(":pKm", $km, PDO::PARAM_INT);
        $req->bindParam(":pFuel", $fuel, PDO::PARAM_STR);
        $req->bindParam(":pHorsepower", $horsepower, PDO::PARAM_INT);
        $req->bindParam(":pUnitprice", $unitPrice, PDO::PARAM_INT);
        $req->bindParam(":pYear", $year, PDO::PARAM_INT);
        $req->bindParam(":pPicture", $picture, PDO::PARAM_STR, 255);
        $req->execute();

    }


}