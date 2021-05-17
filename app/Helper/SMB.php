<?php 

namespace App\Helper;

use App\Models\Coa;
use App\Models\Journal;
use App\Models\Budgeting;

class SMB {

   public static function reportBalanceSheet($filter)
   {
      $month     = date('m', strtotime($filter));
      $year      = date('Y', strtotime($filter));
      $where_raw = "MONTH(created_at) = $month AND YEAR(created_at) = $year";

      $grandtotal_cash_bank             = 0;
      $grandtotal_receivable            = 0;
      $grandtotal_supply                = 0;
      $grandtotal_equip                 = 0;
      $grandtotal_assets_facile         = 0;
      $grandtotal_assets_consistenly    = 0;
      $grandtotal_accumulated_shrinkage = 0;
      $grandtotal_debt                  = 0;
      $grandtotal_responbility          = 0;
      $grandtotal_equity                = 0;

      $cash_bank             = Coa::where('code', '1.000.00')->first();
      $cash_bank_sub_1       = collect(Coa::select('id')->where('parent_id', $cash_bank->id)->get()->toArray());
      $cash_bank_sub_2       = collect(Coa::select('id')->whereIn('parent_id', $cash_bank_sub_1->flatten())->get()->toArray());
      $cash_bank_sub_3       = collect(Coa::select('id')->whereIn('parent_id', $cash_bank_sub_2->flatten())->get()->toArray());
      $cash_bank_merge       = $cash_bank_sub_1->merge($cash_bank_sub_2->merge($cash_bank_sub_3));
      $cash_bank_debit       = Journal::whereIn('debit', $cash_bank_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $cash_bank_credit      = Journal::whereIn('credit', $cash_bank_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_cash_bank       = $cash_bank_debit - $cash_bank_credit;
      $grandtotal_cash_bank += $total_cash_bank;

      $petty_cash        = Coa::where('code', '1.000.01')->first();
      $petty_cash_sub    = Coa::where('parent_id', $petty_cash->id)->get();
      $petty_cash_result = [];
      foreach($petty_cash_sub as $pcs) {
         $sub_1                 = collect(Coa::select('id')->where('parent_id', $pcs->id)->get()->toArray());
         $sub_2                 = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge             = $sub_1->merge(collect([$pcs->id])->merge($sub_2));
         $balance_debit         = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit        = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance         = $balance_debit - $balance_credit;
         $grandtotal_cash_bank += $total_balance;

         $petty_cash_result[] = [
            'name'    => $pcs->name,
            'balance' => $total_balance
         ];
      }

      $big_cash        = Coa::where('code', '1.000.02')->first();
      $big_cash_sub    = Coa::where('parent_id', $big_cash->id)->get();
      $big_cash_result = [];
      foreach($big_cash_sub as $bcs) {
         $sub_1                 = collect(Coa::select('id')->where('parent_id', $bcs->id)->get()->toArray());
         $sub_2                 = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge             = $sub_1->merge(collect([$bcs->id])->merge($sub_2));
         $balance_debit         = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit        = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance         = $balance_debit - $balance_credit;
         $grandtotal_cash_bank += $total_balance;

         $big_cash_result[] = [
            'name'    => $bcs->name,
            'balance' => $total_balance
         ];
      }

      $bank_sby        = Coa::where('code', '1.000.03.01')->first();
      $bank_sby_sub    = Coa::where('parent_id', $bank_sby->id)->get();
      $bank_sby_result = [];
      foreach($bank_sby_sub as $bss) {
         $sub_1                 = collect(Coa::select('id')->where('parent_id', $bss->id)->get()->toArray());
         $sub_2                 = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge             = $sub_1->merge(collect([$bss->id])->merge($sub_2));
         $balance_debit         = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit        = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance         = $balance_debit - $balance_credit;
         $grandtotal_cash_bank += $total_balance;

         $bank_sby_result[] = [
            'name'    => $bss->name,
            'balance' => $total_balance
         ];
      }

      $bank_jkt        = Coa::where('code', '1.000.03.02')->first();
      $bank_jkt_sub    = Coa::where('parent_id', $bank_jkt->id)->get();
      $bank_jkt_result = [];
      foreach($bank_jkt_sub as $bjs) {
         $sub_1                 = collect(Coa::select('id')->where('parent_id', $bjs->id)->get()->toArray());
         $sub_2                 = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge             = $sub_1->merge(collect([$bjs->id])->merge($sub_2));
         $balance_debit         = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit        = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance         = $balance_debit - $balance_credit;
         $grandtotal_cash_bank += $total_balance;

         $bank_jkt_result[] = [
            'name'    => $bjs->name,
            'balance' => $total_balance
         ];
      }

      $receivable             = Coa::where('code', '1.100.00')->first();
      $receivable_sub_1       = collect(Coa::select('id')->where('parent_id', $receivable->id)->get()->toArray());
      $receivable_sub_2       = collect(Coa::select('id')->whereIn('parent_id', $receivable_sub_1->flatten())->get()->toArray());
      $receivable_sub_3       = collect(Coa::select('id')->whereIn('parent_id', $receivable_sub_2->flatten())->get()->toArray());
      $receivable_merge       = $receivable_sub_1->merge($receivable_sub_2->merge($receivable_sub_3));
      $receivable_debit       = Journal::whereIn('debit', $receivable_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $receivable_credit      = Journal::whereIn('credit', $receivable_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_receivable       = $receivable_debit - $receivable_credit;
      $grandtotal_receivable += $total_receivable;

      $dp_purchase        = Coa::where('code', '1.100.01')->first();
      $dp_purchase_sub    = Coa::where('parent_id', $dp_purchase->id)->get();
      $dp_purchase_result = [];
      foreach($dp_purchase_sub as $dps) {
         $sub_1                  = collect(Coa::select('id')->where('parent_id', $dps->id)->get()->toArray());
         $sub_2                  = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge              = $sub_1->merge(collect([$dps->id])->merge($sub_2));
         $balance_debit          = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit         = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance          = $balance_debit - $balance_credit;
         $grandtotal_receivable += $total_balance;

         $dp_purchase_result[] = [
            'name'    => $dps->name,
            'balance' => $total_balance
         ];
      }

      $receivable_effort        = Coa::where('code', '1.100.02')->first();
      $receivable_effort_sub    = Coa::where('parent_id', $receivable_effort->id)->get();
      $receivable_effort_result = [];
      foreach($receivable_effort_sub as $res) {
         $sub_1                  = collect(Coa::select('id')->where('parent_id', $res->id)->get()->toArray());
         $sub_2                  = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge              = $sub_1->merge(collect([$res->id])->merge($sub_2));
         $balance_debit          = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit         = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance          = $balance_debit - $balance_credit;
         $grandtotal_receivable += $total_balance;

         $receivable_effort_result[] = [
            'name'    => $res->name,
            'balance' => $total_balance
         ];
      }

      $advance_purchase        = Coa::where('code', '1.100.03')->first();
      $advance_purchase_sub_1  = collect(Coa::select('id')->where('parent_id', $advance_purchase->id)->get()->toArray());
      $advance_purchase_sub_2  = collect(Coa::select('id')->whereIn('parent_id', $advance_purchase_sub_1->flatten())->get()->toArray());
      $advance_purchase_sub_3  = collect(Coa::select('id')->whereIn('parent_id', $advance_purchase_sub_2->flatten())->get()->toArray());
      $advance_purchase_merge  = $advance_purchase_sub_1->merge($advance_purchase_sub_2->merge($advance_purchase_sub_3));
      $advance_purchase_debit  = Journal::whereIn('debit', $advance_purchase_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $advance_purchase_credit = Journal::whereIn('credit', $advance_purchase_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_advance_purchase  = $advance_purchase_debit - $advance_purchase_credit;
      $grandtotal_receivable  += $total_advance_purchase;

      $supply             = Coa::where('code', '1.200.00')->first();
      $supply_sub_1       = collect(Coa::select('id')->where('parent_id', $supply->id)->get()->toArray());
      $supply_sub_2       = collect(Coa::select('id')->whereIn('parent_id', $supply_sub_1->flatten())->get()->toArray());
      $supply_sub_3       = collect(Coa::select('id')->whereIn('parent_id', $supply_sub_2->flatten())->get()->toArray());
      $supply_merge       = $supply_sub_1->merge($supply_sub_2->merge($supply_sub_3));
      $supply_debit       = Journal::whereIn('debit', $supply_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $supply_credit      = Journal::whereIn('credit', $supply_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_supply       = $supply_debit - $supply_credit;
      $grandtotal_supply += $total_supply;

      $supply_item_sby        = Coa::where('code', '1.200.01')->first();
      $supply_item_sby_sub    = Coa::where('parent_id', $supply_item_sby->id)->get();
      $supply_item_sby_result = [];
      foreach($supply_item_sby_sub as $siss) {
         $sub_1              = collect(Coa::select('id')->where('parent_id', $siss->id)->get()->toArray());
         $sub_2              = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge          = $sub_1->merge(collect([$siss->id])->merge($sub_2));
         $balance_debit      = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit     = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance      = $balance_debit - $balance_credit;
         $grandtotal_supply += $total_balance;

         $supply_item_sby_result[] = [
            'name'    => $siss->name,
            'balance' => $total_balance
         ];
      }

      $supply_item_jkt        = Coa::where('code', '1.200.02')->first();
      $supply_item_jkt_sub    = Coa::where('parent_id', $supply_item_jkt->id)->get();
      $supply_item_jkt_result = [];
      foreach($supply_item_jkt_sub as $sijs) {
         $sub_1              = collect(Coa::select('id')->where('parent_id', $sijs->id)->get()->toArray());
         $sub_2              = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge          = $sub_1->merge(collect([$sijs->id])->merge($sub_2));
         $balance_debit      = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit     = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance      = $balance_debit - $balance_credit;
         $grandtotal_supply += $total_balance;

         $supply_item_jkt_result[] = [
            'name'    => $sijs->name,
            'balance' => $total_balance
         ];
      }

      $sent_item          = Coa::where('code', '1.201.00')->first();
      $sent_item_sub_1    = collect(Coa::select('id')->where('parent_id', $sent_item->id)->get()->toArray());
      $sent_item_sub_2    = collect(Coa::select('id')->whereIn('parent_id', $sent_item_sub_1->flatten())->get()->toArray());
      $sent_item_sub_3    = collect(Coa::select('id')->whereIn('parent_id', $sent_item_sub_2->flatten())->get()->toArray());
      $sent_item_merge    = $sent_item_sub_1->merge($sent_item_sub_2->merge($sent_item_sub_3));
      $sent_item_debit    = Journal::whereIn('debit', $sent_item_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $sent_item_credit   = Journal::whereIn('credit', $sent_item_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_sent_item    = $sent_item_debit - $sent_item_credit;
      $grandtotal_supply += $total_sent_item;

      $equip                     = Coa::where('code', '1.300.00')->first();
      $equip_sub_1               = collect(Coa::select('id')->where('parent_id', $equip->id)->get()->toArray());
      $equip_sub_2               = collect(Coa::select('id')->whereIn('parent_id', $equip_sub_1->flatten())->get()->toArray());
      $equip_sub_3               = collect(Coa::select('id')->whereIn('parent_id', $equip_sub_2->flatten())->get()->toArray());
      $equip_merge               = $equip_sub_1->merge($equip_sub_2->merge($equip_sub_3));
      $equip_debit               = Journal::whereIn('debit', $equip_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $equip_credit              = Journal::whereIn('credit', $equip_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_equip               = $equip_debit - $equip_credit;
      $grandtotal_assets_facile += $total_equip;

      $fee_dp        = Coa::where('code', '1.400.00')->first();
      $fee_dp_sub    = Coa::where('parent_id', $fee_dp->id)->get();
      $fee_dp_result = [];
      foreach($fee_dp_sub as $fds) {
         $sub_1                     = collect(Coa::select('id')->where('parent_id', $fds->id)->get()->toArray());
         $sub_2                     = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge                 = $sub_1->merge(collect([$fds->id])->merge($sub_2));;
         $balance_debit             = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit            = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance             = $balance_debit - $balance_credit;
         $grandtotal_assets_facile += $total_balance;

         $fee_dp_result[] = [
            'name'    => $fds->name,
            'balance' => $total_balance
         ];
      }

      $prepaid_tax        = Coa::where('code', '1.400.00')->first();
      $prepaid_tax_sub    = Coa::where('parent_id', $prepaid_tax->id)->get();
      $prepaid_tax_result = [];
      foreach($prepaid_tax_sub as $pts) {
         $sub_1                     = collect(Coa::select('id')->where('parent_id', $pts->id)->get()->toArray());
         $sub_2                     = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge                 = $sub_1->merge(collect([$pts->id])->merge($sub_2));
         $balance_debit             = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit            = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance             = $balance_debit - $balance_credit;
         $grandtotal_assets_facile += $total_balance;

         $prepaid_tax_result[] = [
            'name'    => $pts->name,
            'balance' => $total_balance
         ];
      }

      $assets_consistenly        = Coa::where('code', '1.600.00')->first();
      $assets_consistenly_sub    = Coa::where('parent_id', $assets_consistenly->id)->get();
      $assets_consistenly_result = [];
      foreach($assets_consistenly_sub as $acs) {
         $sub_1                          = collect(Coa::select('id')->where('parent_id', $acs->id)->get()->toArray());
         $sub_2                          = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge                      = $sub_1->merge(collect([$acs->id])->merge($sub_2));
         $balance_debit                  = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit                 = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance                  = $balance_debit - $balance_credit;
         $grandtotal_assets_consistenly += $total_balance;

         $assets_consistenly_result[] = [
            'name'    => $acs->name,
            'balance' => $total_balance
         ];
      }

      $accumulated_shrinkage        = Coa::where('code', '1.610.00')->first();
      $accumulated_shrinkage_sub    = Coa::where('parent_id', $accumulated_shrinkage->id)->get();
      $accumulated_shrinkage_result = [];
      foreach($accumulated_shrinkage_sub as $ass) {
         $sub_1                             = collect(Coa::select('id')->where('parent_id', $ass->id)->get()->toArray());
         $sub_2                             = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge                         = $sub_1->merge(collect([$ass->id])->merge($sub_2));
         $balance_debit                     = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit                    = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance                     = $balance_debit - $balance_credit;
         $grandtotal_accumulated_shrinkage += $total_balance;

         $accumulated_shrinkage_result[] = [
            'name'    => $ass->name,
            'balance' => $total_balance
         ];
      }

      $debt             = Coa::where('code', '2.000.00')->first();
      $debt_sub_1       = collect(Coa::select('id')->where('parent_id', $debt->id)->get()->toArray());
      $debt_sub_2       = collect(Coa::select('id')->whereIn('parent_id', $debt_sub_1->flatten())->get()->toArray());
      $debt_sub_3       = collect(Coa::select('id')->whereIn('parent_id', $debt_sub_2->flatten())->get()->toArray());
      $debt_merge       = $debt_sub_1->merge($debt_sub_2->merge($debt_sub_3));
      $debt_debit       = Journal::whereIn('debit', $debt_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $debt_credit      = Journal::whereIn('credit', $debt_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_debt       = $debt_debit - $debt_credit;
      $grandtotal_debt += $total_debt;

      $dp_sale        = Coa::where('code', '2.000.01')->first();
      $dp_sale_sub    = Coa::where('parent_id', $dp_sale->id)->get();
      $dp_sale_result = [];
      foreach($dp_sale_sub as $dss) {
         $sub_1            = collect(Coa::select('id')->where('parent_id', $dss->id)->get()->toArray());
         $sub_2            = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge        = $sub_1->merge(collect([$dss->id])->merge($sub_2));
         $balance_debit    = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit   = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance    = $balance_debit - $balance_credit;
         $grandtotal_debt += $total_balance;

         $dp_sale_result[] = [
            'name'    => $dss->name,
            'balance' => $total_balance
         ];
      }

      $dp_sale        = Coa::where('code', '2.000.01')->first();
      $dp_sale_sub    = Coa::where('parent_id', $dp_sale->id)->get();
      $dp_sale_result = [];
      foreach($dp_sale_sub as $dss) {
         $sub_1            = collect(Coa::select('id')->where('parent_id', $dss->id)->get()->toArray());
         $sub_2            = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge        = $sub_1->merge(collect([$dss->id])->merge($sub_2));
         $balance_debit    = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit   = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance    = $balance_debit - $balance_credit;
         $grandtotal_debt += $total_balance;

         $dp_sale_result[] = [
            'name'    => $dss->name,
            'balance' => $total_balance
         ];
      }

      $debt_business        = Coa::where('code', '2.200.00')->first();
      $debt_business_sub    = Coa::where('parent_id', $dp_sale->id)->get();
      $debt_business_result = [];
      foreach($debt_business_sub as $dbs) {
         $sub_1            = collect(Coa::select('id')->where('parent_id', $dbs->id)->get()->toArray());
         $sub_2            = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge        = $sub_1->merge(collect([$dbs->id])->merge($sub_2));
         $balance_debit    = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit   = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance    = $balance_debit - $balance_credit;
         $grandtotal_debt += $total_balance;

         $debt_business_result[] = [
            'name'    => $dbs->name,
            'balance' => $total_balance
         ];
      }

      $advance_sales        = Coa::where('code', '2.200.03')->first();
      $advance_sales_sub_1  = collect(Coa::select('id')->where('parent_id', $advance_sales->id)->get()->toArray());
      $advance_sales_sub_2  = collect(Coa::select('id')->whereIn('parent_id', $advance_sales_sub_1->flatten())->get()->toArray());
      $advance_sales_sub_3  = collect(Coa::select('id')->whereIn('parent_id', $advance_sales_sub_2->flatten())->get()->toArray());
      $advance_sales_merge  = $advance_sales_sub_1->merge($advance_sales_sub_2->merge($advance_sales_sub_3));
      $advance_sales_debit  = Journal::whereIn('debit', $advance_sales_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $advance_sales_credit = Journal::whereIn('credit', $advance_sales_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_advance_sales  = $advance_sales_debit - $advance_sales_credit;
      $grandtotal_debt     += $total_advance_sales;

      $tax        = Coa::where('code', '2.100.00')->first();
      $tax_sub    = Coa::where('parent_id', $tax->id)->get();
      $tax_result = [];
      foreach($tax_sub as $ts) {
         $sub_1                    = collect(Coa::select('id')->where('parent_id', $ts->id)->get()->toArray());
         $sub_2                    = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge                = $sub_1->merge(collect([$ts->id])->merge($sub_2));
         $balance_debit            = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit           = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance            = $balance_debit - $balance_credit;
         $grandtotal_responbility += $total_balance;

         $tax_result[] = [
            'name'    => $ts->name,
            'balance' => $total_balance
         ];
      }

      $other_payable        = Coa::where('code', '2.300.00')->first();
      $other_payable_sub    = Coa::where('parent_id', $other_payable->id)->get();
      $other_payable_result = [];
      foreach($other_payable_sub as $ops) {
         $sub_1                    = collect(Coa::select('id')->where('parent_id', $ops->id)->get()->toArray());
         $sub_2                    = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge                = $sub_1->merge(collect([$ops->id])->merge($sub_2));
         $balance_debit            = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $balance_credit           = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw)->sum('nominal');
         $total_balance            = $balance_debit - $balance_credit;
         $grandtotal_responbility += $total_balance;

         $other_payable_result[] = [
            'name'    => $ops->name,
            'balance' => $total_balance
         ];
      }

      $debt_purchase            = Coa::where('code', '2.400.00')->first();
      $debt_purchase_sub_1      = collect(Coa::select('id')->where('parent_id', $debt_purchase->id)->get()->toArray());
      $debt_purchase_sub_2      = collect(Coa::select('id')->whereIn('parent_id', $debt_purchase_sub_1->flatten())->get()->toArray());
      $debt_purchase_sub_3      = collect(Coa::select('id')->whereIn('parent_id', $debt_purchase_sub_2->flatten())->get()->toArray());
      $debt_purchase_merge      = $debt_purchase_sub_1->merge($debt_purchase_sub_2->merge($debt_purchase_sub_3));
      $debt_purchase_debit      = Journal::whereIn('debit', $debt_purchase_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $debt_purchase_credit     = Journal::whereIn('credit', $debt_purchase_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_debt_purchase      = $debt_purchase_debit - $debt_purchase_credit;
      $grandtotal_responbility += $total_debt_purchase;

      $capital            = Coa::where('code', '3.000.00')->first();
      $capital_sub_1      = collect(Coa::select('id')->where('parent_id', $capital->id)->get()->toArray());
      $capital_sub_2      = collect(Coa::select('id')->whereIn('parent_id', $capital_sub_1->flatten())->get()->toArray());
      $capital_sub_3      = collect(Coa::select('id')->whereIn('parent_id', $capital_sub_2->flatten())->get()->toArray());
      $capital_merge      = $capital_sub_1->merge($capital_sub_2->merge($capital_sub_3));
      $capital_debit      = Journal::whereIn('debit', $capital_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $capital_credit     = Journal::whereIn('credit', $capital_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_capital      = $capital_debit - $capital_credit;
      $grandtotal_equity += $total_capital;

      $opening_balance        = Coa::where('code', '3.100.00')->first();
      $opening_balance_sub_1  = collect(Coa::select('id')->where('parent_id', $opening_balance->id)->get()->toArray());
      $opening_balance_sub_2  = collect(Coa::select('id')->whereIn('parent_id', $opening_balance_sub_1->flatten())->get()->toArray());
      $opening_balance_sub_3  = collect(Coa::select('id')->whereIn('parent_id', $opening_balance_sub_2->flatten())->get()->toArray());
      $opening_balance_merge  = $opening_balance_sub_1->merge($opening_balance_sub_2->merge($opening_balance_sub_3));
      $opening_balance_debit  = Journal::whereIn('debit', $opening_balance_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $opening_balance_credit = Journal::whereIn('credit', $opening_balance_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_opening_balance  = $opening_balance_debit - $opening_balance_credit;
      $grandtotal_equity     += $total_opening_balance;

      $deviden            = Coa::where('code', '3.200.00')->first();
      $deviden_sub_1      = collect(Coa::select('id')->where('parent_id', $deviden->id)->get()->toArray());
      $deviden_sub_2      = collect(Coa::select('id')->whereIn('parent_id', $deviden_sub_1->flatten())->get()->toArray());
      $deviden_sub_3      = collect(Coa::select('id')->whereIn('parent_id', $deviden_sub_2->flatten())->get()->toArray());
      $deviden_merge      = $deviden_sub_1->merge($deviden_sub_2->merge($deviden_sub_3));
      $deviden_debit      = Journal::whereIn('debit', $deviden_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $deviden_credit     = Journal::whereIn('credit', $deviden_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_deviden      = $deviden_debit - $deviden_credit;
      $grandtotal_equity += $total_deviden;

      $retained_earning        = Coa::where('code', '3.300.00')->first();
      $retained_earning_sub_1  = collect(Coa::select('id')->where('parent_id', $retained_earning->id)->get()->toArray());
      $retained_earning_sub_2  = collect(Coa::select('id')->whereIn('parent_id', $retained_earning_sub_1->flatten())->get()->toArray());
      $retained_earning_sub_3  = collect(Coa::select('id')->whereIn('parent_id', $retained_earning_sub_2->flatten())->get()->toArray());
      $retained_earning_merge  = $retained_earning_sub_1->merge($retained_earning_sub_2->merge($retained_earning_sub_3));
      $retained_earning_debit  = Journal::whereIn('debit', $retained_earning_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $retained_earning_credit = Journal::whereIn('credit', $retained_earning_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_retained_earning  = $retained_earning_debit - $retained_earning_credit;
      $grandtotal_equity       += $total_retained_earning;

      $result = [
         'assets' => [
            'cash_bank' => [
               [
                  'name'    => $cash_bank->name,
                  'balance' => $total_cash_bank,
                  'sub'     => []
               ],
               [
                  'name'    => $petty_cash->name,
                  'balance' => null,
                  'sub'     => $petty_cash_result
               ],
               [
                  'name'    => $big_cash->name,
                  'balance' => null,
                  'sub'     => $big_cash_result
               ],
               [
                  'name'    => $bank_sby->name,
                  'balance' => null,
                  'sub'     => $bank_sby_result
               ],
               [
                  'name'    => $bank_jkt->name,
                  'balance' => null,
                  'sub'     => $bank_jkt_result
               ]
            ],
            'receivable' => [
               [
                  'name'    => $receivable->name,
                  'balance' => $total_receivable,
                  'sub'     => []
               ],
               [
                  'name'    => $dp_purchase->name,
                  'balance' => null,
                  'sub'     => $dp_purchase_result
               ],
               [
                  'name'    => $receivable_effort->name,
                  'balance' => null,
                  'sub'     => $receivable_effort_result
               ],
               [
                  'name'    => $advance_purchase->name,
                  'balance' => $total_advance_purchase,
                  'sub'     => []
               ]
            ],
            'supply' => [
               [
                  'name'    => $supply->name,
                  'balance' => $total_supply,
                  'sub'     => []
               ],
               [
                  'name'    => $supply_item_sby->name,
                  'balance' => null,
                  'sub'     => $supply_item_sby_result
               ],
               [
                  'name'    => $supply_item_jkt->name,
                  'balance' => null,
                  'sub'     => $supply_item_jkt_result
               ],
               [
                  'name'    => $sent_item->name,
                  'balance' => $total_sent_item,
                  'sub'     => []
               ]
            ],
            'assets_facile' => [
               [
                  'name'    => $equip->name,
                  'balance' => $total_equip,
                  'sub'     => []
               ],
               [
                  'name'    => $fee_dp->name,
                  'balance' => null,
                  'sub'     => $fee_dp_result
               ],
               [
                  'name'    => $prepaid_tax->name,
                  'balance' => null,
                  'sub'     => $prepaid_tax_result
               ]
            ],
            'assets_consistenly' => [
               [
                  'name'    => $assets_consistenly->name,
                  'balance' => null,
                  'sub'     => $assets_consistenly_result
               ]
            ],
            'accumulated_shrinkage' => [
               [
                  'name'    => $accumulated_shrinkage->name,
                  'balance' => null,
                  'sub'     => $accumulated_shrinkage_result
               ]
            ],
            'total' => [
               'total_cash_bank'             => $grandtotal_cash_bank,
               'total_receivable'            => $grandtotal_receivable,
               'total_supply'                => $grandtotal_supply,
               'total_assets_facile'         => $grandtotal_assets_facile,
               'total_assets_consistenly'    => $grandtotal_assets_consistenly,
               'total_accumulated_shrinkage' => $grandtotal_accumulated_shrinkage
            ]
         ],
         'responbility_equity' => [
            'debt' => [
               [
                  'name'    => $debt->name,
                  'balance' => $total_debt,
                  'sub'     => []
               ],
               [
                  'name'    => $dp_sale->name,
                  'balance' => null,
                  'sub'     => $dp_sale_result
               ],
               [
                  'name'    => $debt_business->name,
                  'balance' => null,
                  'sub'     => $debt_business_result
               ],
               [
                  'name'    => $advance_sales->name,
                  'balance' => $total_advance_sales,
                  'sub'     => []
               ]  
            ],
            'responbility' => [
               [
                  'name'    => $tax->name,
                  'balance' => null,
                  'sub'     => $tax_result
               ],
               [
                  'name'    => $other_payable->name,
                  'balance' => null,
                  'sub'     => $other_payable_result
               ],
               [
                  'name'    => $debt_purchase->name,
                  'balance' => $total_debt_purchase,
                  'sub'     => []
               ]
            ],
            'equity' => [
               [
                  'name'    => $capital->name,
                  'balance' => $total_capital,
                  'sub'     => []
               ],
               [
                  'name'    => $opening_balance->name,
                  'balance' => $total_opening_balance,
                  'sub'     => []
               ],
               [
                  'name'    => $deviden->name,
                  'balance' => $total_deviden,
                  'sub'     => []
               ],
               [
                  'name'    => $retained_earning->name,
                  'balance' => $total_retained_earning,
                  'sub'     => []
               ]
            ],
            'total' => [
               'total_debt'         => $grandtotal_debt,
               'total_responbility' => $grandtotal_responbility,
               'total_equity'       => $grandtotal_equity
            ]
         ]
      ];

      return $result;
   }

   public static function reportProfitLoss($filter)
   {
      $month_current     = date('m', strtotime($filter));
      $year_current      = date('Y', strtotime($filter));
      $where_raw_current = "MONTH(created_at) = $month_current AND YEAR(created_at) = $year_current";
      $month_last        = date('m', strtotime('-1 month', strtotime($filter)));
      $year_last         = date('Y', strtotime('-1 month', strtotime($filter)));
      $where_raw_last    = "MONTH(created_at) = $month_last AND YEAR(created_at) = $year_last";

      $grandtotal_income_actual_current = 0;
      $grandtotal_income_budget         = 0;
      $grandtotal_income_actual_last    = 0;

      $sale        = Coa::where('code', '4.000.01')->first();
      $sale_sub    = Coa::where('parent_id', $sale->id)->get();
      $sale_result = [];
      foreach($sale_sub as $ss) {
         $sub_1     = collect(Coa::select('id')->where('parent_id', $ss->id)->get()->toArray());
         $sub_2     = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge = $sub_1->merge(collect([$ss->id])->merge($sub_2));

         $balance_debit_current  = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
         $balance_credit_current = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
         $total_balance_current  = $balance_debit_current - $balance_credit_current;
         $balance_debit_last     = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
         $balance_credit_last    = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
         $total_balance_last     = $balance_debit_last - $balance_credit_last;

         $budget         = Budgeting::where('coa_id', $ss->id)->whereRaw("MONTH(month) = $month_current AND YEAR(month) = $year_current")->orderByDesc('created_at')->get();
         $budget_nominal = $budget->count() > 0 ? $budget[0]->nominal : 0;

         $grandtotal_income_actual_current += $total_balance_current;
         $grandtotal_income_budget         += $budget_nominal;
         $grandtotal_income_actual_last    += $total_balance_current - $total_balance_last;

         $sale_result[] = [
            'current' => [
               'actual'   => $total_balance_current,
               'budget'   => $budget_nominal,
               'variance' => $total_balance_current - $budget_nominal
            ],
            'last' => [
               'actual'   => $total_balance_last,
               'variance' => $total_balance_current - $total_balance_last
            ],
            'name' => $ss->name
         ];
      }     

      $sale_service        = Coa::where('code', '4.000.02')->first();
      $sale_service_sub    = Coa::where('parent_id', $sale->id)->get();
      $sale_service_result = [];
      foreach($sale_service_sub as $sss) {
         $sub_1     = collect(Coa::select('id')->where('parent_id', $sss->id)->get()->toArray());
         $sub_2     = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
         $sub_merge = $sub_1->merge(collect([$sss->id])->merge($sub_2));

         $balance_debit_current  = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
         $balance_credit_current = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
         $total_balance_current  = $balance_debit_current - $balance_credit_current;
         $balance_debit_last     = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
         $balance_credit_last    = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
         $total_balance_last     = $balance_debit_last - $balance_credit_last;

         $budget         = Budgeting::where('coa_id', $sss->id)->whereRaw("MONTH(month) = $month_current AND YEAR(month) = $year_current")->orderByDesc('created_at')->get();
         $budget_nominal = $budget->count() > 0 ? $budget[0]->nominal : 0;

         $grandtotal_income_actual_current += $total_balance_current;
         $grandtotal_income_budget         += $budget_nominal;
         $grandtotal_income_actual_last    += $total_balance_current - $total_balance_last;

         $sale_service_result[] = [
            'current' => [
               'actual'   => $total_balance_current,
               'budget'   => $budget_nominal,
               'variance' => $total_balance_current - $budget_nominal
            ],
            'last' => [
               'actual'   => $total_balance_last,
               'variance' => $total_balance_current - $total_balance_last
            ],
            'name' => $sss->name
         ];
      }
      
      $result = [
         'sby_jkt' => [
            'income' => [ 
               'sale' => [
                  'name' => $sale->name,
                  'sub'  => $sale_result
               ],
               'sale_service' => [
                  'name' => $sale_service->name,
                  'sub'  => $sale_service_result
               ],
               'total_actual_current' => $grandtotal_income_actual_current,
               'total_budget'         => $grandtotal_income_budget,
               'total_actual_last'    => $grandtotal_income_actual_last
            ],
         ],
      ];

      return $result;
   }

}