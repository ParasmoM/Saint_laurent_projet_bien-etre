<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\ProvidersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesOfServicesRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProvidersController extends AbstractController
{
    #[Route('/providers/get-data', name: 'get_data', methods: ['POST'])]
    public function getData(Request $request): JsonResponse
    {
        $data = [
            [
                "Code" => 4000,
                "Localite" => "Glain",
                "Commune" => "Liège"
            ],
            [
                "Code" => 4000,
                "Localite" => "Liège",
                "Commune" => "Liège"
            ],
            [
                "Code" => 4000,
                "Localite" => "Rocourt",
                "Commune" => "Liège"
            ],
            [
                "Code" => 4020,
                "Localite" => "Bressoux",
                "Commune" => "Liège"
            ],
            [
                "Code" => 4020,
                "Localite" => "Jupille-Sur-Meuse",
                "Commune" => "Liège"
            ],
            [
                "Code" => 4020,
                "Localite" => "Liège",
                "Commune" => "Liège"
            ],
            [
                "Code" => 4020,
                "Localite" => "Wandre",
                "Commune" => "Liège"
            ],
            [
                "Code" => 4030,
                "Localite" => "Grivegnée",
                "Commune" => "Liège"
            ],
            [
                "Code" => 4031,
                "Localite" => "Angleur",
                "Commune" => "Liège"
            ],
            [
                "Code" => 4032,
                "Localite" => "Chênée",
                "Commune" => "Liège"
            ],
            [
                "Code" => 4040,
                "Localite" => "Herstal",
                "Commune" => "Herstal"
            ],
            [
                "Code" => 4041,
                "Localite" => "Milmort",
                "Commune" => "Herstal"
            ],
            [
                "Code" => 4041,
                "Localite" => "Vottem",
                "Commune" => "Herstal"
            ],
            [
                "Code" => 4042,
                "Localite" => "Liers",
                "Commune" => "Herstal"
            ],
            [
                "Code" => 4050,
                "Localite" => "Chaudfontaine",
                "Commune" => "Chaudfontaine"
            ],
            [
                "Code" => 4051,
                "Localite" => "Vaux-Sous-Chèvremont",
                "Commune" => "Chaudfontaine"
            ],
            [
                "Code" => 4052,
                "Localite" => "Beaufays",
                "Commune" => "Chaudfontaine"
            ],
            [
                "Code" => 4053,
                "Localite" => "Embourg",
                "Commune" => "Chaudfontaine"
            ],
            [
                "Code" => 4100,
                "Localite" => "Boncelles",
                "Commune" => "Seraing"
            ],
            [
                "Code" => 4100,
                "Localite" => "Seraing",
                "Commune" => "Seraing"
            ],
            [
                "Code" => 4101,
                "Localite" => "Jemeppe-Sur-Meuse",
                "Commune" => "Seraing"
            ],
            [
                "Code" => 4102,
                "Localite" => "Ougrée",
                "Commune" => "Seraing"
            ],
            [
                "Code" => 4120,
                "Localite" => "Ehein",
                "Commune" => "Neupré"
            ],
            [
                "Code" => 4120,
                "Localite" => "Neupré",
                "Commune" => "Neupré"
            ],
            [
                "Code" => 4120,
                "Localite" => "Rotheux-Rimière",
                "Commune" => "Neupré"
            ],
            [
                "Code" => 4121,
                "Localite" => "Neuvilleen-Condroz",
                "Commune" => "Neupré"
            ],
            [
                "Code" => 4122,
                "Localite" => "Neupré",
                "Commune" => "Neupré"
            ],
            [
                "Code" => 4122,
                "Localite" => "Plainevaux",
                "Commune" => "Neupré"
            ],
            [
                "Code" => 4130,
                "Localite" => "Tilff",
                "Commune" => "Esneux"
            ],
            [
                "Code" => 4140,
                "Localite" => "Dolembreux",
                "Commune" => "Sprimont"
            ],
            [
                "Code" => 4140,
                "Localite" => "Gomze-Andoumont",
                "Commune" => "Sprimont"
            ],
            [
                "Code" => 4140,
                "Localite" => "Rouvreux",
                "Commune" => "Sprimont"
            ],
            [
                "Code" => 4140,
                "Localite" => "Sprimont",
                "Commune" => "Sprimont"
            ],
            [
                "Code" => 4141,
                "Localite" => "Louveigné",
                "Commune" => "Sprimont"
            ],
            [
                "Code" => 4160,
                "Localite" => "Anthisnes",
                "Commune" => "Anthisnes"
            ],
            [
                "Code" => 4161,
                "Localite" => "Villers-Aux-Tours",
                "Commune" => "Anthisnes"
            ],
            [
                "Code" => 4162,
                "Localite" => "Hody",
                "Commune" => "Anthisnes"
            ],
            [
                "Code" => 4163,
                "Localite" => "Tavier",
                "Commune" => "Anthisnes"
            ],
            [
                "Code" => 4170,
                "Localite" => "Comblainau-Pont",
                "Commune" => "Comblain-Au-Pont"
            ],
            [
                "Code" => 4171,
                "Localite" => "Poulseur",
                "Commune" => "Comblain-Au-Pont"
            ],
            [
                "Code" => 4180,
                "Localite" => "Comblain-Fairon",
                "Commune" => "Hamoir"
            ],
            [
                "Code" => 4180,
                "Localite" => "Comblain-La-Tour",
                "Commune" => "Hamoir"
            ],
            [
                "Code" => 4180,
                "Localite" => "Hamoir",
                "Commune" => "Hamoir"
            ],
            [
                "Code" => 4181,
                "Localite" => "Filot",
                "Commune" => "Hamoir"
            ],
            [
                "Code" => 4190,
                "Localite" => "Ferrières",
                "Commune" => "Ferrières"
            ],
            [
                "Code" => 4190,
                "Localite" => "My",
                "Commune" => "Ferrières"
            ],
            [
                "Code" => 4190,
                "Localite" => "Vieuxville",
                "Commune" => "Ferrières"
            ],
            [
                "Code" => 4190,
                "Localite" => "Werbomont",
                "Commune" => "Ferrières"
            ],
            [
                "Code" => 4190,
                "Localite" => "Xhoris",
                "Commune" => "Ferrières"
            ],
            [
                "Code" => 4210,
                "Localite" => "Burdinne",
                "Commune" => "Burdinne"
            ],
            [
                "Code" => 4210,
                "Localite" => "Hannêche",
                "Commune" => "Burdinne"
            ],
            [
                "Code" => 4210,
                "Localite" => "Lamontzée",
                "Commune" => "Burdinne"
            ],
            [
                "Code" => 4210,
                "Localite" => "Marneffe",
                "Commune" => "Burdinne"
            ],
            [
                "Code" => 4210,
                "Localite" => "Oteppe",
                "Commune" => "Burdinne"
            ],
            [
                "Code" => 4210,
                "Localite" => "Vissoul",
                "Commune" => "Burdinne"
            ],
            [
                "Code" => 4217,
                "Localite" => "Héron",
                "Commune" => "Héron"
            ],
            [
                "Code" => 4217,
                "Localite" => "Héron Lavoir",
                "Commune" => "Héron"
            ],
            [
                "Code" => 4217,
                "Localite" => "Waret-L'Evêque",
                "Commune" => "Héron"
            ],
            [
                "Code" => 4218,
                "Localite" => "Héron Couthuin",
                "Commune" => "Héron"
            ],
            [
                "Code" => 4219,
                "Localite" => "Acosse",
                "Commune" => "Wasseiges"
            ],
            [
                "Code" => 4219,
                "Localite" => "Ambresin",
                "Commune" => "Wasseiges"
            ],
            [
                "Code" => 4219,
                "Localite" => "Wasseiges",
                "Commune" => "Wasseiges"
            ],
            [
                "Code" => 4219,
                "Localite" => "Wasseiges Meeffe",
                "Commune" => "Wasseiges"
            ],
            [
                "Code" => 4250,
                "Localite" => "Geer",
                "Commune" => "Geer"
            ],
            [
                "Code" => 4250,
                "Localite" => "Geer Boëlhe",
                "Commune" => "Geer"
            ],
            [
                "Code" => 4250,
                "Localite" => "Geer Hollogne-Sur-Geer",
                "Commune" => "Geer"
            ],
            [
                "Code" => 4250,
                "Localite" => "Lens-Saint-Servais",
                "Commune" => "Geer"
            ],
            [
                "Code" => 4252,
                "Localite" => "Omal",
                "Commune" => "Geer"
            ],
            [
                "Code" => 4253,
                "Localite" => "Darion",
                "Commune" => "Geer"
            ],
            [
                "Code" => 4254,
                "Localite" => "Ligney",
                "Commune" => "Geer"
            ],
            [
                "Code" => 4257,
                "Localite" => "Berloz",
                "Commune" => "Berloz"
            ],
            [
                "Code" => 4257,
                "Localite" => "Corswarem",
                "Commune" => "Berloz"
            ],
            [
                "Code" => 4257,
                "Localite" => "Rosoux-Crenwick",
                "Commune" => "Berloz"
            ],
            [
                "Code" => 4260,
                "Localite" => "Braives",
                "Commune" => "Braives"
            ],
            [
                "Code" => 4260,
                "Localite" => "Ciplet",
                "Commune" => "Braives"
            ],
            [
                "Code" => 4260,
                "Localite" => "Fallais",
                "Commune" => "Braives"
            ],
            [
                "Code" => 4260,
                "Localite" => "Fumal",
                "Commune" => "Braives"
            ],
            [
                "Code" => 4260,
                "Localite" => "Vennes",
                "Commune" => "Braives"
            ],
            [
                "Code" => 4260,
                "Localite" => "Ville-En-Hesbaye",
                "Commune" => "Braives"
            ],
            [
                "Code" => 4261,
                "Localite" => "Latinne",
                "Commune" => "Braives"
            ],
            [
                "Code" => 4263,
                "Localite" => "Tourinne",
                "Commune" => "Braives"
            ],
            [
                "Code" => 4280,
                "Localite" => "Abolens",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Avernasle-Bauduin",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Avin",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Bertrée",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Blehen",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Cras-Avernas",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Crehen",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Grand-Hallet",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Hannut",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Lens-Saint-Remy",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Merdorp",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Moxhe",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Petit-Hallet",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Poucet",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Thisnes",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Trognée",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Villers-Le-Peuplier",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4280,
                "Localite" => "Wansin",
                "Commune" => "Hannut"
            ],
            [
                "Code" => 4287,
                "Localite" => "Lincent",
                "Commune" => "Lincent"
            ],
            [
                "Code" => 4287,
                "Localite" => "Pellaines",
                "Commune" => "Lincent"
            ],
            [
                "Code" => 4287,
                "Localite" => "Racour",
                "Commune" => "Lincent"
            ],
            [
                "Code" => 4300,
                "Localite" => "Bettincourt",
                "Commune" => "Waremme"
            ],
            [
                "Code" => 4300,
                "Localite" => "Bleret",
                "Commune" => "Waremme"
            ],
            [
                "Code" => 4300,
                "Localite" => "Bovenistier",
                "Commune" => "Waremme"
            ],
            [
                "Code" => 4300,
                "Localite" => "Grand-Axhe",
                "Commune" => "Waremme"
            ],
            [
                "Code" => 4300,
                "Localite" => "Lantremange",
                "Commune" => "Waremme"
            ],
            [
                "Code" => 4300,
                "Localite" => "Oleye",
                "Commune" => "Waremme"
            ],
            [
                "Code" => 4300,
                "Localite" => "Waremme",
                "Commune" => "Waremme"
            ],
            [
                "Code" => 4317,
                "Localite" => "Aineffe",
                "Commune" => "Faimes"
            ],
            [
                "Code" => 4317,
                "Localite" => "Borlez",
                "Commune" => "Faimes"
            ],
            [
                "Code" => 4317,
                "Localite" => "Celles",
                "Commune" => "Faimes"
            ],
            [
                "Code" => 4317,
                "Localite" => "Faimes",
                "Commune" => "Faimes"
            ],
            [
                "Code" => 4317,
                "Localite" => "Les Waleffes",
                "Commune" => "Faimes"
            ],
            [
                "Code" => 4317,
                "Localite" => "Viemme",
                "Commune" => "Faimes"
            ],
            [
                "Code" => 4340,
                "Localite" => "Awans",
                "Commune" => "Awans"
            ],
            [
                "Code" => 4340,
                "Localite" => "Fooz",
                "Commune" => "Awans"
            ],
            [
                "Code" => 4340,
                "Localite" => "Othée",
                "Commune" => "Awans"
            ],
            [
                "Code" => 4340,
                "Localite" => "Villersl'Evêque",
                "Commune" => "Awans"
            ],
            [        
                "Code" => 4342,        
                "Localite" => "Hognoul",                
                "Commune" => "Awans"    
            ],
            [        
                "Code" => 4347,
                "Localite" => "Fexhe-Le-Haut-Clocher",
                "Commune" => "Fexhe-Le-Haut-Clocher"
            ],
            [        
                "Code" => 4347,        
                "Localite" => "Freloux",                
                "Commune" => "Fexhe-Le-Haut-Clocher"    
            ],
            [        
                "Code" => 4347,   
                "Localite" => "Noville",           
                "Commune" => "Fexhe-Le-Haut-Clocher"
            ],
            [        
                "Code" => 4347,        
                "Localite" => "Roloux",                 
                "Commune" => "Fexhe-Le-Haut-Clocher"    
            ],
            [        
                "Code" => 4347,        
                "Localite" => "Voroux-Goreux",          
                "Commune" => "Fexhe-Le-Haut-Clocher"    
            ],
            [        
                "Code" => 4350,        
                "Localite" => "Lamine",                 
                "Commune" => "Remicourt"    
            ],
            [        
                "Code" => 4350,        
                "Localite" => "Momalle",                
                "Commune" => "Remicourt"    
            ],
            [        
                "Code" => 4350,        
                "Localite" => "Pousset",                
                "Commune" => "Remicourt"    
            ],
            [        
                "Code" => 4350,        
                "Localite" => "Remicourt",              
                "Commune" => "Remicourt"    
            ],
            [        
                "Code" => 4351,        
                "Localite" => "Hodeige",                
                "Commune" => "Remicourt"    
            ],
            [        
                "Code" => 4357,        
                "Localite" => "Donceel",                
                "Commune" => "Donceel"    
            ],
            [        
                "Code" => 4357,        
                "Localite" => "Haneffe",                
                "Commune" => "Donceel"    
            ],
            [        
                "Code" => 4357,        
                "Localite" => "Jeneffe",                
                "Commune" => "Donceel"    
            ],
            [        
                "Code" => 4357,        
                "Localite" => "Limont",                 
                "Commune" => "Donceel"    
            ],
            [        
                "Code" => 4360,        
                "Localite" => "Bergilers",              
                "Commune" => "Oreye"    
            ],
            [        
                "Code" => 4360,        
                "Localite" => "Grandville",             
                "Commune" => "Oreye"    
            ],
            [        
                "Code" => 4360,        
                "Localite" => "Lenssur-Geer",           
                "Commune" => "Oreye"    
            ],
            [        
                "Code" => 4360,        
                "Localite" => "Oreye",                  
                "Commune" => "Oreye"    
            ],
            [        
                "Code" => 4360,        
                "Localite" => "Otrange",                
                "Commune" => "Oreye"    
            ],
            [        
                "Code" => 4367,        
                "Localite" => "Crisnée",                
                "Commune" => "Crisnée"    
            ],
            [        
                "Code" => 4367,        
                "Localite" => "Fize-Le-Marsal",         
                "Commune" => "Crisnée"    
            ],
            [        
                "Code" => 4367,        
                "Localite" => "Kemexhe",                
                "Commune" => "Crisnée"    
            ],
            [        
                "Code" => 4367,        
                "Localite" => "Odeur",                  
                "Commune" => "Crisnée"    
            ],
            [        
                "Code" => 4367,        
                "Localite" => "Thys",                   
                "Commune" => "Crisnée"    
            ],
            [        
                "Code" => 4400,        
                "Localite" => "Awirs",                  
                "Commune" => "Flémalle"    
            ],
            [        
                "Code" => 4400,        
                "Localite" => "Chokier",                
                "Commune" => "Flémalle"    
            ],
            [        
                "Code" => 4400,        
                "Localite" => "Flémalle",               
                "Commune" => "Flémalle"    
            ],
            [        
                "Code" => 4400,        
                "Localite" => "Flémalle-Grande",        
                "Commune" => "Flémalle"    
            ],
            [        
                "Code" => 4400,        
                "Localite" => "Flémalle-Haute",         
                "Commune" => "Flémalle"    
            ],
            [        
                "Code" => 4400,        
                "Localite" => "Gleixhe",                
                "Commune" => "Flémalle"    
            ],
            [        
                "Code" => 4400,        
                "Localite" => "Ivoz-Ramet",             
                "Commune" => "Flémalle"    
            ],
            [        
                "Code" => 4400,        
                "Localite" => "Les Cahottes",           
                "Commune" => "Flémalle"    
            ],
            [        
                "Code" => 4400,        
                "Localite" => "Mons-Lez-Liège",         
                "Commune" => "Flémalle"    
            ],
            [        
                "Code" => 4420,        
                "Localite" => "Montegnée",              
                "Commune" => "Saint-Nicolas"    
            ],
            [        
                "Code" => 4420,        
                "Localite" => "Saint-Nicolas",          
                "Commune" => "Saint-Nicolas"    
            ],
            [        
                "Code" => 4420,        
                "Localite" => "Tilleur",                
                "Commune" => "Saint-Nicolas"    
            ],
            [        
                "Code" => 4430,        
                "Localite" => "Ans",                    
                "Commune" => "Ans"    
            ],
            [        
                "Code" => 4431,        
                "Localite" => "Loncin",                 
                "Commune" => "Ans"    
            ],
            [        
                "Code" => 4432,        
                "Localite" => "Alleur",                 
                "Commune" => "Ans"    
            ],
            [        
                "Code" => 4432,        
                "Localite" => "Xhendremael",           
                "Commune" => "Ans"    
            ],
            [        
                "Code" => 4450,        
                "Localite" => "Juprelle",               
                "Commune" => "Juprelle"    
            ],
            [        
                "Code" => 4450,        
                "Localite" => "Lantin",                 
                "Commune" => "Juprelle"    
            ],
            [        
                "Code" => 4450,        
                "Localite" => "Slins",                  
                "Commune" => "Juprelle"    
            ],
            [        
                "Code" => 4451,        
                "Localite" => "Voroux-Lez-Liers",       
                "Commune" => "Juprelle"    
            ],
            [        
                "Code" => 4452,        
                "Localite" => "Paifve",                 
                "Commune" => "Juprelle"    
            ],
            [        
                "Code" => 4452,        
                "Localite" => "Wihogne",                
                "Commune" => "Juprelle"    
            ],
            [        
                "Code" => 4453,        
                "Localite" => "Villers-Saint-Siméon",   
                "Commune" => "Juprelle"    
            ],
            [        
                "Code" => 4458,        
                "Localite" => "Fexhe-Slins",            
                "Commune" => "Juprelle"    
            ],
            [        
                "Code" => 4460,        
                "Localite" => "Bierset",                
                "Commune" => "Grâce-Hollogne"    
            ],
            [        
                "Code" => 4460,        
                "Localite" => "Grâce-Berleur",          
                "Commune" => "Grâce-Hollogne"    
            ],
            [        
                "Code" => 4460,        
                "Localite" => "Grâce-Hollogne",         
                "Commune" => "Grâce-Hollogne"    
            ],
            [        
                "Code" => 4460,        
                "Localite" => "Hollogne-Aux-Pierres",   
                "Commune" => "Grâce-Hollogne"    
            ],
            [        
                "Code" => 4460,        
                "Localite" => "Horion-Hozémont",        
                "Commune" => "Flémalle"    
            ],
            [        
                "Code" => 4460,        
                "Localite" => "Horion-Hozémont",        
                "Commune" => "Grâce-Hollogne"    
            ],
            [        
                "Code" => 4460,        
                "Localite" => "Velroux",                
                "Commune" => "Grâce-Hollogne"    
            ],
            [        
                "Code" => 4470,        
                "Localite" => "Saint-Georges-Sur-Meuse",
                "Commune" => "Saint-Georges-Sur-Meuse"    
            ],
            [        
                "Code" => 4480,        
                "Localite" => "Clermont-Sous-Huy",      
                "Commune" => "Engis"    
            ],
            [        
                "Code" => 4480,        
                "Localite" => "Ehein",                  
                "Commune" => "Engis"    
            ],
            [        
                "Code" => 4480,        
                "Localite" => "Engis",                  
                "Commune" => "Engis"    
            ],
            [        
                "Code" => 4480,        
                "Localite" => "Hermalle-Sous-Huy",      
                "Commune" => "Engis"    
            ],
            [        
                "Code" => 4500,        
                "Localite" => "Ben-Ahin",               
                "Commune" => "Huy"    
            ],
            [        
                "Code" => 4500,        
                "Localite" => "Huy",                    
                "Commune" => "Huy"    
            ],
            [        
                "Code" => 4500,        
                "Localite" => "Tihange",                
                "Commune" => "Huy"    
            ],
            [        
                "Code" => 4520,        
                "Localite" => "Antheit",                
                "Commune" => "Wanze"    
            ],
            [        
                "Code" => 4520,        
                "Localite" => "Bas-Oha",                
                "Commune" => "Wanze"    
            ],
            [        
                "Code" => 4520,        
                "Localite" => "Huccorgne",              
                "Commune" => "Wanze"    
            ],
            [        
                "Code" => 4520,        
                "Localite" => "Moha",                   
                "Commune" => "Wanze"    
            ],
            [        
                "Code" => 4520,        
                "Localite" => "Vinalmont",              
                "Commune" => "Wanze"    
            ],
            [        
                "Code" => 4520,        
                "Localite" => "Wanze",                  
                "Commune" => "Wanze"    
            ],
            [        
                "Code" => 4530,        
                "Localite" => "Fize-Fontaine",          
                "Commune" => "Villers-Le-Bouillet"    
            ],
            [        
                "Code" => 4530,        
                "Localite" => "Vaux-Et-Borset",         
                "Commune" => "Villers-Le-Bouillet"    
            ],
            [        
                "Code" => 4530,        
                "Localite" => "Vieux-Waleffe",          
                "Commune" => "Villers-Le-Bouillet"    
            ],
            [        
                "Code" => 4530,        
                "Localite" => "Villersle-Bouillet",     
                "Commune" => "Villers-Le-Bouillet"    
            ],
            [        
                "Code" => 4530,        
                "Localite" => "Warnant-Dreye",          
                "Commune" => "Villers-Le-Bouillet"    
            ],
            [        
                "Code" => 4537,        
                "Localite" => "Bodegnée",               
                "Commune" => "Verlaine"    
            ],
            [        
                "Code" => 4537,        
                "Localite" => "Chapon-Seraing",         
                "Commune" => "Verlaine"    
            ],
            [        
                "Code" => 4537,        
                "Localite" => "Seraing-Le-Château",     
                "Commune" => "Verlaine"    
            ],
            [        
                "Code" => 4537,        
                "Localite" => "Verlaine",               
                "Commune" => "Verlaine"    
            ],
            [        
                "Code" => 4540,        
                "Localite" => "Amay",                   
                "Commune" => "Amay"    
            ],
            [        
                "Code" => 4540,        
                "Localite" => "Amay Flône",             
                "Commune" => "Amay"    
            ],
            [        
                "Code" => 4540,        
                "Localite" => "Ampsin",                 
                "Commune" => "Amay"    
            ],
            [        
                "Code" => 4540,        
                "Localite" => "Jehay",                  
                "Commune" => "Amay"    
            ],
            [        
                "Code" => 4540,        
                "Localite" => "Ombret",                 
                "Commune" => "Amay"    
            ],
            [        
                "Code" => 4550,        
                "Localite" => "Nandrin",                
                "Commune" => "Nandrin"    
            ],
            [        
                "Code" => 4550,        
                "Localite" => "Saint-Séverin",          
                "Commune" => "Nandrin"    
            ],
            [        
                "Code" => 4550,        
                "Localite" => "Villers-Le-Temple",      
                "Commune" => "Nandrin"    
            ],
            [        
                "Code" => 4550,        
                "Localite" => "Yernée-Fraineux",        
                "Commune" => "Nandrin"    
            ],
            [        
                "Code" => 4557,        
                "Localite" => "Abée",                   
                "Commune" => "Tinlot"    
            ],
            [        
                "Code" => 4557,        
                "Localite" => "Fraiture",               
                "Commune" => "Tinlot"    
            ],
            [        
                "Code" => 4557,        
                "Localite" => "Ramelot",                
                "Commune" => "Tinlot"    
            ],
            [        
                "Code" => 4557,        
                "Localite" => "Scry",                   
                "Commune" => "Tinlot"    
            ],
            [        
                "Code" => 4557,        
                "Localite" => "Seny",                   
                "Commune" => "Tinlot"    
            ],
            [        
                "Code" => 4557,        
                "Localite" => "Soheit-Tinlot",          
                "Commune" => "Tinlot"    
            ],
            [        
                "Code" => 4557,        
                "Localite" => "Tinlot",                 
                "Commune" => "Tinlot"    
            ],
            [        
                "Code" => 4560,        
                "Localite" => "Bois-Et-Borsu",          
                "Commune" => "Clavier"    
            ],
            [        
                "Code" => 4560,        
                "Localite" => "Clavier",                
                "Commune" => "Clavier"    
            ],
            [        
                "Code" => 4560,        
                "Localite" => "Les Avins",              
                "Commune" => "Clavier"    
            ],
            [        
                "Code" => 4560,        
                "Localite" => "Ocquier",                
                "Commune" => "Clavier"    
            ],
            [        
                "Code" => 4560,        
                "Localite" => "Pailhe",                 
                "Commune" => "Clavier"    
            ],
            [        
                "Code" => 4560,        
                "Localite" => "Terwagne",               
                "Commune" => "Clavier"    
            ],
            [        
                "Code" => 4570,        
                "Localite" => "Marchin",                
                "Commune" => "Marchin"    
            ],
            [        
                "Code" => 4570,        
                "Localite" => "Vyle-Et-Tharoul",        
                "Commune" => "Marchin"    
            ],
            [        
                "Code" => 4577,        
                "Localite" => "Modave",                 
                "Commune" => "Modave"    
            ],
            [        
                "Code" => 4577,        
                "Localite" => "Outrelouxhe",            
                "Commune" => "Modave"    
            ],
            [        
                "Code" => 4577,        
                "Localite" => "Outrelouxhe",            
                "Commune" => "Modave"    
            ],
            [        
                "Code" => 4577,        
                "Localite" => "Strée-Lez-Huy",          
                "Commune" => "Modave"    
            ],
            [        
                "Code" => 4577,        
                "Localite" => "Vierset-Barse",          
                "Commune" => "Modave"    
            ],
            [        
                "Code" => 4590,        
                "Localite" => "Ellemelle",              
                "Commune" => "Ouffet"    
            ],
            [        
                "Code" => 4590,        
                "Localite" => "Ouffet",                 
                "Commune" => "Ouffet"    
            ],
            [        
                "Code" => 4590,        
                "Localite" => "Warzée",                 
                "Commune" => "Ouffet"    
            ],
            [        
                "Code" => 4600,        
                "Localite" => "Lanaye",                 
                "Commune" => "Visé"    
            ],
            [        
                "Code" => 4600,        
                "Localite" => "Lixhe",                  
                "Commune" => "Visé"    
            ],
            [        
                "Code" => 4600,        
                "Localite" => "Richelle",               
                "Commune" => "Visé"    
            ],
            [        
                "Code" => 4600,        
                "Localite" => "Visé",                   
                "Commune" => "Visé"    
            ],
            [        
                "Code" => 4601,        
                "Localite" => "Argenteau",              
                "Commune" => "Visé"    
            ],
            [        
                "Code" => 4602,        
                "Localite" => "Cheratte",               
                "Commune" => "Visé"    
            ],
            [        
                "Code" => 4606,        
                "Localite" => "Saint-André",            
                "Commune" => "Dalhem"    
            ],
            [        
                "Code" => 4607,        
                "Localite" => "Berneau",                
                "Commune" => "Dalhem"    
            ],
            [        
                "Code" => 4607,        
                "Localite" => "Bombaye",                
                "Commune" => "Dalhem"    
            ],
            [        
                "Code" => 4607,        
                "Localite" => "Dalhem",                 
                "Commune" => "Dalhem"    
            ],
            [        
                "Code" => 4607,        
                "Localite" => "Feneur",                 
                "Commune" => "Dalhem"    
            ],
            [        
                "Code" => 4607,        
                "Localite" => "Mortroux",               
                "Commune" => "Dalhem"    
            ],
            [        
                "Code" => 4608,        
                "Localite" => "Neufchâteau",            
                "Commune" => "Dalhem"    
            ],
            [        
                "Code" => 4608,        
                "Localite" => "Warsage",                
                "Commune" => "Dalhem"    
            ],
            [        
                "Code" => 4610,        
                "Localite" => "Bellaire",               
                "Commune" => "Beyne-Heusay"    
            ],
            [        
                "Code" => 4610,        
                "Localite" => "Beyne-Heusay",           
                "Commune" => "Beyne-Heusay"    
            ],
            [        
                "Code" => 4610,        
                "Localite" => "Queue-Du-Bois",          
                "Commune" => "Beyne-Heusay"    
            ],
            [        
                "Code" => 4620,        
                "Localite" => "Fléron",                 
                "Commune" => "Fléron"    
            ],
            [        
                "Code" => 4621,        
                "Localite" => "Retinne",                
                "Commune" => "Fléron"    
            ],
            [        
                "Code" => 4623,        
                "Localite" => "Magnée",                 
                "Commune" => "Fléron"    
            ],
            [        
                "Code" => 4624,        
                "Localite" => "Romsée",                 
                "Commune" => "Fléron"    
            ],
            [        
                "Code" => 4630,        
                "Localite" => "Ayeneux",                
                "Commune" => "Soumagne"    
            ],
            [        
                "Code" => 4630,        
                "Localite" => "Micheroux",              
                "Commune" => "Soumagne"    
            ],
            [        
                "Code" => 4630,        
                "Localite" => "Soumagne",               
                "Commune" => "Soumagne"    
            ],
            [        
                "Code" => 4630,        
                "Localite" => "Tignée",                 
                "Commune" => "Soumagne"    
            ],
            [        
                "Code" => 4631,        
                "Localite" => "Evegnée",                
                "Commune" => "Soumagne"    
            ],
            [        
                "Code" => 4632,        
                "Localite" => "Cerexhe-Heuseux",        
                "Commune" => "Soumagne"    
            ],
            [        
                "Code" => 4633,        
                "Localite" => "Melen",                  
                "Commune" => "Soumagne"    
            ],
            [        
                "Code" => 4650,        
                "Localite" => "Chaineux",               
                "Commune" => "Herve"    
            ],
            [        
                "Code" => 4650,        
                "Localite" => "Grand-Rechain",          
                "Commune" => "Herve"    
            ],
            [        
                "Code" => 4650,        
                "Localite" => "Herve",                  
                "Commune" => "Herve"    
            ],
            [        
                "Code" => 4650,        
                "Localite" => "Chaineux",               
                "Commune" => "Herve"    
            ],
            [        
                "Code" => 4650,        
                "Localite" => "Grand-Rechain",          
                "Commune" => "Herve"    
            ],
            [        
                "Code" => 4650,        
                "Localite" => "Herve",                  
                "Commune" => "Herve"    
            ],
            [        
                "Code" => 4650,        
                "Localite" => "Julémont",               
                "Commune" => "Herve"    
            ],
            [        
                "Code" => 4651,        
                "Localite" => "Battice",                
                "Commune" => "Herve"    
            ],
            [        
                "Code" => 4652,        
                "Localite" => "Xhendelesse",            
                "Commune" => "Herve"    
            ],
            [        
                "Code" => 4653,        
                "Localite" => "Bolland",                
                "Commune" => "Herve"    
            ],
            [        
                "Code" => 4654,        
                "Localite" => "Charneux",               
                "Commune" => "Herve"    
            ],
            [        
                "Code" => 4670,        
                "Localite" => "Blégny",                 
                "Commune" => "Blegny"    
            ],
            [        
                "Code" => 4670,        
                "Localite" => "Mortier",                
                "Commune" => "Blegny"    
            ],
            [        
                "Code" => 4670,        
                "Localite" => "Trembleur",              
                "Commune" => "Blegny"    
            ],
            [        
                "Code" => 4671,        
                "Localite" => "Barchon",                
                "Commune" => "Blegny"    
            ],
            [        
                "Code" => 4671,        
                "Localite" => "Housse",                 
                "Commune" => "Blegny"    
            ],
            [        
                "Code" => 4671,        
                "Localite" => "Saive",                  
                "Commune" => "Blegny"    
            ],
            [        
                "Code" => 4672,        
                "Localite" => "Saint-Remy",             
                "Commune" => "Blegny"    
            ],
            [        
                "Code" => 4680,        
                "Localite" => "Hermée",                 
                "Commune" => "Oupeye"    
            ],
            [        
                "Code" => 4680,        
                "Localite" => "Oupeye",                 
                "Commune" => "Oupeye"    
            ],
            [        
                "Code" => 4681,        
                "Localite" => "Hermalle-Sous-Argenteau",
                "Commune" => "Oupeye"    
            ],
            [        
                "Code" => 4682,        
                "Localite" => "Heure-Le-Romain",        
                "Commune" => "Oupeye"    
            ],
            [        
                "Code" => 4682,        
                "Localite" => "Houtain-Saint-Siméon",   
                "Commune" => "Oupeye"    
            ],
            [        
                "Code" => 4683,        
                "Localite" => "Vivegnis",               
                "Commune" => "Oupeye"    
            ],
            [
                "Code" => 4684,
                "Localite" => "Haccourt",
                "Commune" => "Oupeye"
            ],
            [
                "Code" => 4690,
                "Localite" => "Bassenge",
                "Commune" => "Bassenge"
            ],
            [
                "Code" => 4690,
                "Localite" => "Boirs",
                "Commune" => "Bassenge"
            ],
            [
                "Code" => 4690,
                "Localite" => "Eben-Emael",
                "Commune" => "Bassenge"
            ],
            [
                "Code" => 4690,
                "Localite" => "Glons",
                "Commune" => "Bassenge"
            ],
            [
                "Code" => 4690,
                "Localite" => "Roclenge-Sur-Geer",
                "Commune" => "Bassenge"
            ],
            [
                "Code" => 4690,
                "Localite" => "Wonck",
                "Commune" => "Bassenge"
            ],
            [
                "Code" => 4700,
                "Localite" => "Eupen",
                "Commune" => "Eupen"
            ],
            [
                "Code" => 4701,
                "Localite" => "Kettenis",
                "Commune" => "Eupen"
            ],
            [
                "Code" => 4710,
                "Localite" => "Lontzen",
                "Commune" => "Lontzen"
            ],
            [
                "Code" => 4711,
                "Localite" => "Walhorn",
                "Commune" => "Lontzen"
            ],
            [
                "Code" => 4720,
                "Localite" => "Kelmis",
                "Commune" => "Kelmis"
            ],
            [
                "Code" => 4721,
                "Localite" => "Neu-Moresnet",
                "Commune" => "Kelmis"
            ],
            [
                "Code" => 4728,
                "Localite" => "Hergenrath",
                "Commune" => "Kelmis"
            ],
            [
                "Code" => 4730,
                "Localite" => "Hauset",
                "Commune" => "Raeren"
            ],
            [
                "Code" => 4730,
                "Localite" => "Raeren",
                "Commune" => "Raeren"
            ],
            [
                "Code" => 4731,
                "Localite" => "Eynatten",
                "Commune" => "Raeren"
            ],
            [
                "Code" => 4750,
                "Localite" => "Bütgenbach",
                "Commune" => "Bütgenbach"
            ],
            [
                "Code" => 4750,
                "Localite" => "Elsenborn",
                "Commune" => "Bütgenbach"
            ],
            [
                "Code" => 4760,
                "Localite" => "Büllingen",
                "Commune" => "Bullange"
            ],
            [
                "Code" => 4760,
                "Localite" => "Manderfeld",
                "Commune" => "Bullange"
            ],
            [
                "Code" => 4761,
                "Localite" => "Rocherath",
                "Commune" => "Bullange"
            ],
            [
                "Code" => 4770,
                "Localite" => "Amel",
                "Commune" => "Amel"
            ],
            [
                "Code" => 4770,
                "Localite" => "Meyrode",
                "Commune" => "Amel"
            ],
            [
                "Code" => 4771,
                "Localite" => "Heppenbach",
                "Commune" => "Amel"
            ],
            [
                "Code" => 4780,
                "Localite" => "Recht",
                "Commune" => "Saint-Vith"
            ],
            [
                "Code" => 4780,
                "Localite" => "Sankt Vith",
                "Commune" => "Saint-Vith"
            ],
            [
                "Code" => 4782,
                "Localite" => "Schönberg",
                "Commune" => "Saint-Vith"
            ],
            [
                "Code" => 4783,
                "Localite" => "Lommersweiler",
                "Commune" => "Saint-Vith"
            ],
            [
                "Code" => 4784,
                "Localite" => "Crombach",
                "Commune" => "Saint-Vith"
            ],
            [
                "Code" => 4790,
                "Localite" => "Burg-Reuland",
                "Commune" => "Burg-Reuland"
            ],
            [
                "Code" => 4790,
                "Localite" => "Reuland",
                "Commune" => "Burg-Reuland"
            ],
            [
                "Code" => 4791,
                "Localite" => "Thommen",
                "Commune" => "Burg-Reuland"
            ],
            [
                "Code" => 4800,
                "Localite" => "Ensival",
                "Commune" => "Verviers"
            ],
            [
                "Code" => 4800,
                "Localite" => "Lambermont",
                "Commune" => "Verviers"
            ],
            [
                "Code" => 4800,
                "Localite" => "Petit-Rechain",
                "Commune" => "Verviers"
            ],
            [
                "Code" => 4800,
                "Localite" => "Polleur",
                "Commune" => "Verviers"
            ],
            [
                "Code" => 4800,
                "Localite" => "Verviers",
                "Commune" => "Verviers"
            ],
            [
                "Code" => 4801,
                "Localite" => "Stembert",
                "Commune" => "Verviers"
            ],
            [
                "Code" => 4802,
                "Localite" => "Heusy",
                "Commune" => "Verviers"
            ],
            [
                "Code" => 4820,
                "Localite" => "Dison",
                "Commune" => "Dison"
            ],
            [
                "Code" => 4821,
                "Localite" => "Andrimont",
                "Commune" => "Dison"
            ],
            [
                "Code" => 4830,
                "Localite" => "Limbourg",
                "Commune" => "Limbourg"
            ],
            [
                "Code" => 4831,
                "Localite" => "Bilstain",
                "Commune" => "Limbourg"
            ],
            [
                "Code" => 4834,
                "Localite" => "Goé",
                "Commune" => "Limbourg"
            ],
            [
                "Code" => 4837,
                "Localite" => "Baelen",
                "Commune" => "Baelen"
            ],
            [
                "Code" => 4837,
                "Localite" => "Membach",
                "Commune" => "Baelen"
            ],
            [
                "Code" => 4840,
                "Localite" => "Welkenraedt",
                "Commune" => "Welkenraedt"
            ],
            [
                "Code" => 4841,
                "Localite" => "Henri-Chapelle",
                "Commune" => "Welkenraedt"
            ],
            [
                "Code" => 4845,
                "Localite" => "Jalhay",
                "Commune" => "Jalhay"
            ],
            [
                "Code" => 4845,
                "Localite" => "Sart-Lez-Spa",
                "Commune" => "Jalhay"
            ],
            [
                "Code" => 4850,
                "Localite" => "Montzen",
                "Commune" => "Plombières"
            ],
            [
                "Code" => 4850,
                "Localite" => "Moresnet",
                "Commune" => "Plombières"
            ],
            [
                "Code" => 4850,
                "Localite" => "Plombières",
                "Commune" => "Plombières"
            ],
            [
                "Code" => 4851,
                "Localite" => "Gemmenich",
                "Commune" => "Plombières"
            ],
            [
                "Code" => 4851,
                "Localite" => "Sippenaeken",
                "Commune" => "Plombières"
            ],
            [
                "Code" => 4852,
                "Localite" => "Hombourg",
                "Commune" => "Plombières"
            ],
            [
                "Code" => 4860,
                "Localite" => "Cornesse",
                "Commune" => "Pepinster"
            ],
            [
                "Code" => 4860,
                "Localite" => "Pepinster",
                "Commune" => "Pepinster"
            ],
            [
                "Code" => 4860,
                "Localite" => "Wegnez",
                "Commune" => "Pepinster"
            ],
            [
                "Code" => 4861,
                "Localite" => "Soiron",
                "Commune" => "Pepinster"
            ],
            [
                "Code" => 4870,
                "Localite" => "Forêt",
                "Commune" => "Trooz"
            ],
            [
                "Code" => 4870,
                "Localite" => "Fraipont",
                "Commune" => "Trooz"
            ],
            [
                "Code" => 4870,
                "Localite" => "Nessonvaux",
                "Commune" => "Trooz"
            ],
            [
                "Code" => 4870,
                "Localite" => "Trooz",
                "Commune" => "Trooz"
            ],
            [
                "Code" => 4877,
                "Localite" => "Olne",
                "Commune" => "Olne"
            ],
            [
                "Code" => 4880,
                "Localite" => "Aubel",
                "Commune" => "Aubel"
            ],
            [
                "Code" => 4890,
                "Localite" => "Clermont",
                "Commune" => "Thimister-Clermont"
            ],
            [
                "Code" => 4890,
                "Localite" => "Thimister",
                "Commune" => "Thimister-Clermont"
            ],
            [
                "Code" => 4890,
                "Localite" => "Thimister-Clermont",
                "Commune" => "Thimister-Clermont"
            ],
            [
                "Code" => 4900,
                "Localite" => "Spa",
                "Commune" => "Spa"
            ],
            [
                "Code" => 4910,
                "Localite" => "La Reid",
                "Commune" => "Theux"
            ],
            [
                "Code" => 4910,
                "Localite" => "Polleur",
                "Commune" => "Theux"
            ],
            [
                "Code" => 4910,
                "Localite" => "Theux",
                "Commune" => "Theux"
            ],
            [
                "Code" => 4920,
                "Localite" => "Aywaille",
                "Commune" => "Aywaille"
            ],
            [
                "Code" => 4920,
                "Localite" => "Ernonheid",
                "Commune" => "Aywaille"
            ],
            [
                "Code" => 4920,
                "Localite" => "Harzé",
                "Commune" => "Aywaille"
            ],
            [
                "Code" => 4920,
                "Localite" => "Louveigné",
                "Commune" => "Aywaille"
            ],
            [
                "Code" => 4920,
                "Localite" => "Sougné-Remouchamps",
                "Commune" => "Aywaille"
            ],
            [
                "Code" => 4950,
                "Localite" => "Faymonville",
                "Commune" => "Waimes"
            ],
            [
                "Code" => 4950,
                "Localite" => "Robertville",
                "Commune" => "Waimes"
            ],
            [
                "Code" => 4950,
                "Localite" => "Sourbrodt",
                "Commune" => "Waimes"
            ],
            [
                "Code" => 4950,
                "Localite" => "Waimes",
                "Commune" => "Waimes"
            ],
            [
                "Code" => 4960,
                "Localite" => "Bellevaux-Ligneuville",
                "Commune" => "Malmedy"
            ],
            [
                "Code" => 4960,
                "Localite" => "Bevercé",
                "Commune" => "Malmedy"
            ],
            [
                "Code" => 4960,
                "Localite" => "Malmedy",
                "Commune" => "Malmedy"
            ],
            [
                "Code" => 4970,
                "Localite" => "Coo",
                "Commune" => "Stavelot"
            ],
            [
                "Code" => 4970,
                "Localite" => "Francorchamps",
                "Commune" => "Stavelot"
            ],
            [
                "Code" => 4970,
                "Localite" => "Stavelot",
                "Commune" => "Stavelot"
            ],
            [
                "Code" => 4980,
                "Localite" => "Fosse",
                "Commune" => "Trois-Ponts"
            ],
            [
                "Code" => 4980,
                "Localite" => "Trois-Ponts",
                "Commune" => "Trois-Ponts"
            ],
            [
                "Code" => 4980,
                "Localite" => "Wanne",
                "Commune" => "Trois-Ponts"
            ],
            [
                "Code" => 4983,
                "Localite" => "Basse-Bodeux",
                "Commune" => "Trois-Ponts"
            ],
            [
                "Code" => 4987,
                "Localite" => "Cheneux",
                "Commune" => "Stoumont"
            ],
            [
                "Code" => 4987,
                "Localite" => "Chevron",
                "Commune" => "Stoumont"
            ],
            [
                "Code" => 4987,
                "Localite" => "La Gleize",
                "Commune" => "Stoumont"
            ],
            [
                "Code" => 4987,
                "Localite" => "Lorcé",
                "Commune" => "Stoumont"
            ],
            [
                "Code" => 4987,
                "Localite" => "Monceau",
                "Commune" => "Stoumont"
            ],
            [
                "Code" => 4987,
                "Localite" => "Rahier",
                "Commune" => "Stoumont"
            ],
            [
                "Code" => 4987,
                "Localite" => "Stoumont",
                "Commune" => "Stoumont"
            ],
            [
                "Code" => 4987,
                "Localite" => "Targnon",
                "Commune" => "Stoumont"
            ],
            [
                "Code" => 4990,
                "Localite" => "Arbrefontaine",
                "Commune" => "Lierneux"
            ],
            [
                "Code" => 4990,
                "Localite" => "Bra",
                "Commune" => "Lierneux"
            ],
            [
                "Code" => 4990,
                "Localite" => "Lierneux",
                "Commune" => "Lierneux"
            ]
            
        ];

        $filters = json_decode($request->getContent(), true);
        
        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                $filter = [$key => $value];
            }
        }

        // if (!empty($filter)) {
            $result = [];
            foreach ($filter as $key => $value) {
                foreach ($data as $keyData => $valueData) {
                    $d = $valueData;
                    foreach ($d as $k => $v) {
                        if (strtolower($key) == strtolower($k) && strtolower($value) == strtolower($v)) {
                            $result[] = $d;
                        }
                    }
                }
            }
    
            if ($request->getMethod() == 'POST') {
                return new JsonResponse($result);
            }
        // }
        // return new JsonResponse(['action'=>'data vide']);
    }
    
    #[Route('/providers', name: 'app_providers', methods: ['GET'])]
    public function index(
        Request $request,
        CategoriesOfServicesRepository $categRepository,
        ProvidersRepository $providersRepository,
    ): Response {
        $list_categ = $categRepository->findAll();

        // Récupérez le numéro de la page à partir de la requête, utilisez 1 par défaut si aucune page n'est fournie
        $page = $request->query->get('page', 1);

        // On récupère les prestataires paginer en fonction du filtre 
        $providers = $providersRepository->findByProviders($_GET, $page);

        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);
        
        return $this->render('providers/provider.html.twig', compact(
            'list_categ',
            'providers',
            'form'
        ));
    }
}
