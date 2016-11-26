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


        return \View::make("foods",compact('result'))
            //->with("name", "something")
            ->render();

    }

    public function foodista3(Request $request){

    	// Setup some additional prefixes for Foodista
    	\EasyRdf_Namespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
    	\EasyRdf_Namespace::set('owl', 'http://www.w3.org/2002/07/owl#');
    	\EasyRdf_Namespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
    	\EasyRdf_Namespace::set('cat', 'http://www.w3.org/2004/02/skos/core#prefLabel');
    	
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
    		if ($request->likes){
    			foreach ($request->likes as $ing){
    				$filter=$filter."filter contains(?ing".$i.",'".$ing."') .\n";
    				$labels=$labels."?obj".$i." rdfs:label ?ing".$i.".\n";
    				$objs=$objs." ?obj".$i.",";
    				$i=$i+1;
    			}
    		}
    		$objs=substr($objs, 0, -1);
    		$filterN=' ';
    		$labelsN=' ';
    		$objsN=' ';
    		if ($request->dislikes){
    			foreach ($request->dislikes as $ing){
    				$filterN=$filterN."filter (!contains(?ing".$i.",'".$ing."') ).\n";
    				$labelsN=$labelsN." ?objN".$i." rdfs:label ?ing".$i.".\n";
    				$objsN=$objsN.", ?obj".$i;
    				$i=$i+1;
    			}
    	
    			$objsN=substr($objsN, 0, -1);
    		}
    		$foodcat="";
    		if ($request->catmeal!="None")
    			$foodcat ="?cat1 cat: '".$request->catmeal."'.\n";
    		  
    			//run query
    			$result1 = $sparql->query(
    					"SELECT   distinct ?subjectName ?img ?links ?abstract ?subject
					WHERE {
					      ?subject <http://linkedrecipes.org/schema/ingredient>  ".$objs.$objsN.".\n
					      ?subject <http://purl.org/dc/terms/title> ?subjectName.\n
						  ?subject <http://xmlns.com/foaf/0.1/isPrimaryTopicOf> ?links.	\n
						  ?subject <http://xmlns.com/foaf/0.1/depiction> ?img.\n
						  ?subject <http://linkedrecipes.org/schema/category> ?cat1.
						  ?subject <http://purl.org/dc/terms/description> ?abstract.
					      ".$labels.$labelsN."
					      ".$filter.$filterN.$foodcat."
    	
					}
					Limit 16"
    					);
    	
    			 
			// Setup some additional prefixes for DBpedia
		\EasyRdf_Namespace::set('category', 'http://dbpedia.org/resource/Category:');
		\EasyRdf_Namespace::set('dbpedia', 'http://dbpedia.org/resource/');
		\EasyRdf_Namespace::set('dbo', 'http://dbpedia.org/ontology/');
		\EasyRdf_Namespace::set('dbp', 'http://dbpedia.org/property/');
		
		//return $request->sings;
		
		$sparql = new \EasyRdf_Sparql_Client('http://dbpedia.org/sparql');
		$filter=' ';
		if ($request->likes)
			foreach ($request->likes as $ing)
				$filter=$filter."filter contains(?inglist,'".$ing."') .\n";
		$filterN=' ';
		if ($request->dislikes)
			foreach ($request->dislikes as $ing)
				$filterN=$filterN."filter (!contains(?inglist,'".$ing."') ).\n";
		
		$foodcat="";
		if ($request->catmeal!="None")
			$foodcat ="?cat1 cat: '".$request->catmeal."'.\n";
			 
			//run query
			$result2 = $sparql->query(
					"SELECT   distinct ?subject ?img ?links
					WHERE {
						  ?subject rdf:type <http://dbpedia.org/ontology/Food>.\n
						  ?subject dbo:ingredientName ?inglist.\n
						  ?subject foaf:isPrimaryTopicOf ?links.\n
						  ?subject foaf:depiction ?img.\n
					      ".$filter.$filterN."
		
					}
					Limit 16"
					);

//				$result=$result1;
//		dd($result);
			return \View::make("FoodistaShow",compact('result1'), compact('result2'))
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
    
    public function Fooddet(Request $request){
    	
    	// Setup some additional prefixes for Foodista
    	\EasyRdf_Namespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
    	\EasyRdf_Namespace::set('owl', 'http://www.w3.org/2002/07/owl#');
    	\EasyRdf_Namespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
    	\EasyRdf_Namespace::set('cat', 'http://www.w3.org/2004/02/skos/core#prefLabel');
    	$sparql = new \EasyRdf_Sparql_Client('http://localhost:3030/Foodista/query');
    	//run query
    	$result = $sparql->query(
    			"SELECT   distinct ?subject ?prop ?value
					WHERE {
					      ?subject ?prop ?value    	
					}
					Limit 16"
    			);
    	
    	return \View::make("Fooddetail",compact('result'))
    	//->with("name", "something")
    	->render();
    	 
    	 
    	 
    }

 }
