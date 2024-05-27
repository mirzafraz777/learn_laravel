<?php

namespace App\Models;

class Listing
{
    public static function all()
    {

        return [
            [
                'id'=>'1',
                'title'=>'Post One',
                'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                Nihil culpa quos dolore, ab enim distinctio pariatur, 
                                ipsum rem itaque cupiditate incidunt laboriosam, sit rerum. Nihil.'
            ],
            [
                'id'=>'2',
                'title'=>'Post Two',
                'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                Nihil culpa quos dolore, ab enim distinctio pariatur, 
                                ipsum rem itaque cupiditate incidunt laboriosam, sit rerum. Nihil.'

            ],
            [
                'id'=>'3',
                'title'=>'Post Three',
                'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                Nihil culpa quos dolore, ab enim distinctio pariatur, 
                                ipsum rem itaque cupiditate incidunt laboriosam, sit rerum. Nihil.'

            ]
        ];
    }

    public static function find($id){
        $listings = self::all();
        foreach ($listings as $listing):
            if($listing['id']==$id):
                return $listing;
            endif;
        endforeach;
    }




}
