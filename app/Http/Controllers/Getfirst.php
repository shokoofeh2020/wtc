<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Getfirst extends Controller
{
    //
    public function show(){
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

        $sparql = new \EasyRdf_Sparql_Client('http://dbpedia.org/sparql');

        $result = $sparql->query(
            "SELECT distinct ?food ?ing
     WHERE {   
       ?food rdf:type <http://dbpedia.org/ontology/Food> .
       ?food dbo:ingredientName ?ing
       filter contains(?ing,'honey')
       filter contains(?ing,'flour')
       }

     ORDER BY ?food
     limit 100"

        );

        foreach ($result as $row) {
            echo "<li>".$row->food."\t::";
            echo "".$row->ing."</li>\n";
        }
        dd($result);
    }
}
