<!-- <h3>Termometri</h3> -->
<?php
    echo '<div class="col-sm-4">';
    class Appartamento {
        public $codice;
        public $nome;
        public $abitato;
        public $causadisabitato;
        public $termometri;


        function __construct($codice, $nome, $termometri, $abitato) {
            $this->codice = $codice;
            $this->nome = $nome;
            $this->abitato = $abitato;
            $this->causadisabitato = null;
            $this->termometri = $termometri;
        }
        
        function setAbitato() {
            $this->abitato = TRUE;
            $this->causadisabitato = null;
        }
        function setDisabitato($motivo) {
            $this->abitato = FALSE;
            $this->causadisabitato = $motivo;
        }
        function setTermometro($new, $pos) {
            if($pos<sizeof($this->termometri) && $pos >= 0) {
                $this->termometri[$pos] = $new;
            }
        }

    }
    class Termometro {
        public $codice;
        public $stanza;
        public $min;
        public $max;
        public $temp;


        function __construct($codice, $stanza, $min, $max) {
            $this->codice = $codice;
            $this->stanza = $stanza;
            if($min<0){     // se il range non rispetta i vincoli forniti nella consegna, li imposta ai vincoli
                $min = 0;
            }
            if($max>40){
                $max = 40;
            }
            $this->min = $min;
            $this->max = $max;
        }
        
        function setRilevata($temp) {
            if($this->checkRange($temp)){
                $this->temp = $temp;
            }
        }

        /**
         * Controlla che la temperatura rispetti i range
         * TRUE se li rispetta
         * FALSE se non li rispetta
         */
        function checkRange($temp) {
            if($temp > $this->max){
                return FALSE;
            }
            if($temp < $this->min){
                return FALSE;
            }
            return TRUE;
        }
        

    }
    $app1 = "";
    // $app1->setDisabitato("venduta");
    if(file_get_contents('dati.txt')==""){      // se non ho l'appartameno in memoria lo creo
        $term1 = new Termometro(1, "salotto", 5, 38);
        $term1->setRilevata(21);
        $term2 = new Termometro(2, "camera", 7, 29);
        $term2->setRilevata(18);
    
        $app1 = new Appartamento(0, "casa al mare", array($term1, $term2), TRUE);
        $sU = serialize($app1);
        file_put_contents('dati.txt', $sU);
    }
    if(file_get_contents('dati.txt')!=""){
        $y = file_get_contents('dati.txt');
        $app1 = unserialize($y);
    }
    $par = "";
    $par2 = "";
    if($app1->abitato){
        $par = 1;
    }else{
        $par = 0;
    }

    echo "<h3>" . $app1->nome . "</h3>";
    
    /**
     * Creo la struttura per modificare lo stato di abitazione
     */
    echo '<form method="POST">';
    echo '<label for="ab">Abitato:</label> <input type="number" id="ab" name="abili" value="' . $par . '">';
    echo '<label for="mot">Aggiorna motivo per cui non è abitata</label> <input type="text" id="mot" name="motivo">';
    echo '<input type="submit"></form>';
    if($app1->abitato==0){      // se è disabitato aggiungo il motivo
        echo "<p>Motivo per cui è disabitato: " . $app1->causadisabitato . "</p>";
    }
    echo '</div>';
    if(file_get_contents('dati.txt')==""){
        $sU = serialize($app1);
        file_put_contents('dati.txt', $sU);
    }
    
    
?>
<?php
/**
 * Scorro l'array dei termometri e creo i form per modificare i vari dati
 */
    echo '<div class="col-sm-4">';
    $t = $app1->termometri;
    //var_dump($t);
    for($i=0; $i<sizeof($t); $i++){
        echo "<h3>Termometro " . $t[$i]->stanza . "</h3>";
        echo "<p>Temperatura rilevata: <span>" . $t[$i]->temp . "</span></p>";
        echo '<form method="POST"> <label>Modifica temperatura</label> <input type="number" name="tem' . $i . '">';
        echo '<input type="submit">';
        echo "</form>";
    }

    echo '</div>';
    if(file_get_contents('dati.txt')==""){
        $sU = serialize($app1);
        file_put_contents('dati.txt', $sU);
    }
?>

<?php
/**
 * CONTROLLI PER I CAMBIAMENTI
 */
    if($_POST['tem0']!=null){
        $x = $app1->termometri[0];
        $x->setRilevata($_POST['tem0']);
        $app1->setTermometro($x, 0);
        $sU = serialize($app1);
        file_put_contents('dati.txt', $sU);
    }
    if($_POST['tem1']!=null){
        $x = $app1->termometri[1];
        $x->setRilevata($_POST['tem1']);
        $app1->setTermometro($x, 1);
        $sU = serialize($app1);
        file_put_contents('dati.txt', $sU);
    }
    if($_POST['abili']!=null){
        if($_POST['abili']==1){
            $app1->setAbitato();
            $sU = serialize($app1);
            file_put_contents('dati.txt', $sU);
        }else if($_POST['abili']==0){
            $app1->setDisabitato($_POST['motivo']);
            $sU = serialize($app1);
            file_put_contents('dati.txt', $sU);
        }
}
?>
