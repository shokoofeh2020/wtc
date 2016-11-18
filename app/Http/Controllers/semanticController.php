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
            "SELECT distinct ?food ?ing
             WHERE {   
               ?food rdf:type <http://dbpedia.org/ontology/Food> .
               ?food dbo:ingredientName ?ing".
                $filter .
            "}
                 ORDER BY ?food
                 limit 100"
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

    public function convert(){
        //require_once "easyrdf\easyrdf\lib\EasyRdf.php";
            // Parse the input
        $graph = new  \EasyRdf_Graph('http://wtc.app/foodista-');

            $graph->load('http://wtc.app/foodista-', 'turtle');

            // Lookup the output format
            $format = \EasyRdf_Format::getFormat('rdf');
            // Serialise to the new output format
            $output = $graph->serialise($format);
            if (!is_scalar($output)) {
                $output = var_export($output, true);
            }
            // Send the output back to the client

            //header('Content-Type: ' . $format->getDefaultMimeType());
            dd($output);

    }
}
