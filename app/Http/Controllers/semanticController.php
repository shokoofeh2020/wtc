<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class semanticController extends Controller
{
    //
    public function searchFood(Request $request){
//        $file = file_get_contents('http://data.lirmm.fr/ontologies/food.rdf');
//        $parser = new \EasyRdf_Parser_RdfXml();
//        $graph = new \EasyRdf_Graph();
//        $parser->parse($graph, $file, 'rdfxml', null);
//        print $graph->dump('text');

        ////////////////////////////

        // Setup some additional prefixes for DBpedia
        \EasyRdf_Namespace::set('category', 'http://dbpedia.org/resource/Category:');
        \EasyRdf_Namespace::set('dbpedia', 'http://dbpedia.org/resource/');
        \EasyRdf_Namespace::set('dbo', 'http://dbpedia.org/ontology/');
        \EasyRdf_Namespace::set('dbp', 'http://dbpedia.org/property/');

        //return $request->sings;

        $sparql = new \EasyRdf_Sparql_Client('http://dbpedia.org/sparql');

        $filter=' ';
        foreach ($request->sings as $ing)
            $filter=$filter."filter contains(?ing,'".$ing."') ";

        //return $filter;

        //run query
        $result = $sparql->query(
            "SELECT distinct ?food ?ing ?img
             WHERE {   
               ?food rdf:type <http://dbpedia.org/ontology/Food> .
               ?food dbo:ingredientName ?ing.
        	   ?food foaf:depiction ?img".
                $filter .
            "}
                 ORDER BY ?food
                 limit 16"
        );

//        foreach ($result as $row) {
//            echo "<li>".$row->food."\t::";
//            echo "".$row->ing."</li>\n";
//        }
        //dd($result);
        //return $result;
        return \View::make("foods",compact('result'))
            //->with("name", "something")
            ->render();

    }

    public function foodista3(Request $request){

        // Setup some additional prefixes for Foodista
        \EasyRdf_Namespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
        \EasyRdf_Namespace::set('owl', 'http://www.w3.org/2002/07/owl#');
        \EasyRdf_Namespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');

//        echo 'you like:';
//        foreach ($request->likes as $like)
//        	echo '<li>'.$like.'</li>';
//        echo '<br>you dislike:';
//        foreach ($request->dislikes as $dislike)
//            echo '<li>'.$dislike.'</li>';
//        echo '<br>you whant to eat me at:';
//        dd($request->when);
        $sparql = new \EasyRdf_Sparql_Client('http://localhost:3030/Foodista/query');
         

        
        $i=1;
        $filter=' ';
        $labels=' ';
        $objs=' ';
        foreach ($request->likes as $ing){
        	$filter=$filter."filter contains(?ing".$i.",'".$ing."') .\n";
        	$labels=$labels."?obj".$i." rdfs:label ?ing".$i.".\n";
        	$objs=$objs." ?obj".$i.",";
        	$i=$i+1;
	    }
	    
	    $filterN=' ';
	    $labelsN=' ';
	    $objsN=' ';
	     foreach ($request->dislikes as $ing){
	    	$filterN=$filterN."filter (!contains(?ing".$i.",'".$ing."') ).\n";
	    	$labelsN=$labelsN." ?objN".$i." rdfs:label ?ing".$i.".\n";
	    	$objsN=$objsN.", ?obj".$i;
	    	$i=$i+1;
	    }
	     $objs=substr($objs, 0, -1);
	     $objsN=substr($objsN, 0, -1);
	    
	    ini_set('max_execution_time', 180); //3 minutes
	    
        //run query
		$result = $sparql->query(
				"SELECT   distinct ?subjectName ?img ?links
					WHERE {
					      ?subject <http://linkedrecipes.org/schema/ingredient>  ".$objs.$objsN.".\n
					      ?subject <http://purl.org/dc/terms/title> ?subjectName.\n
						  ?subject <http://xmlns.com/foaf/0.1/isPrimaryTopicOf> ?links.	\n
						  ?subject <http://xmlns.com/foaf/0.1/depiction> ?img.\n
					      ".$labels.$labelsN."
					      ".$filter.$filterN."
					}
					Limit 16"
				);
		
		//dd($result);
		return \View::make("FoodistaShow",compact('result'))
		//->with("name", "something")
		->render();
        
            }

    public function searchIngs(Request $request){
// Setup some additional prefixes for DBpedia
        \EasyRdf_Namespace::set('category', 'http://dbpedia.org/resource/Category:');
        \EasyRdf_Namespace::set('dbpedia', 'http://dbpedia.org/resource/');
        \EasyRdf_Namespace::set('dbo', 'http://dbpedia.org/ontology/');
        \EasyRdf_Namespace::set('dbp', 'http://dbpedia.org/property/');

        //return $request->sings;

        $sparql = new \EasyRdf_Sparql_Client('http://dbpedia.org/sparql');

//        $filter=' ';
//        foreach ($request->sings as $ing)
//            $filter=$filter."filter contains(?ing,'".$ing."') ";

        //return $filter;

        //run query
        $result = $sparql->query(
            "select distinct ?label where {
                ?food rdf:type <http://dbpedia.org/ontology/Food> .
                ?food dbo:ingredient ?ing.
                ?ing rdfs:label ?label.
                filter (lang(?label)='en')
                }"
        );

        dd($result);
    }

 }
