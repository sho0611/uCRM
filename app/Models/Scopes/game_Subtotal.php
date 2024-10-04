<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class game_Subtotal implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $sql = 'select 
        game_purchases.id as id,
        game_purchase_games.id as pivot_id,
        game_customers.name as customer_name,
        games.price * game_purchase_games.quantity as subtotal,
        games.name as game_name, 
        games.price as game_price,
        game_purchase_games.quantity, 
        game_purchases.status,
        game_purchases.created_at, 
        game_purchases.updated_at
        
        from game_purchases
        
        left join  game_purchase_games on game_purchases.id = game_purchase_games.game_purchase_id
        left join games on game_purchase_games.games_id = games.id
        left join game_customers on game_purchases.game_customer_id = game_customers.id';
        
        $builder->fromSub($sql, 'game_order_subtotals');
    }
}
