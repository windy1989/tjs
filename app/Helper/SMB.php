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
      $advance_purchase_merge  = $advance_purchase_sub_1->merge($advance_purchase_sub_2->merge($advance_purchase_sub_3->merge([$advance_purchase->id])));
      $advance_purchase_debit  = Journal::whereIn('debit', $advance_purchase_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $advance_purchase_credit = Journal::whereIn('credit', $advance_purchase_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_advance_purchase  = $advance_purchase_debit - $advance_purchase_credit;
      $grandtotal_receivable  += $total_advance_purchase;

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
      $sent_item_merge    = $sent_item_sub_1->merge($sent_item_sub_2->merge($sent_item_sub_3->merge([$sent_item->id])));
      $sent_item_debit    = Journal::whereIn('debit', $sent_item_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $sent_item_credit   = Journal::whereIn('credit', $sent_item_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_sent_item    = $sent_item_debit - $sent_item_credit;
      $grandtotal_supply += $total_sent_item;

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
      $debt_business_sub    = Coa::where('parent_id', $debt_business->id)->get();
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
      $debt_purchase_merge      = $debt_purchase_sub_1->merge($debt_purchase_sub_2->merge($debt_purchase_sub_3->merge([$debt_purchase->id])));
      $debt_purchase_debit      = Journal::whereIn('debit', $debt_purchase_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $debt_purchase_credit     = Journal::whereIn('credit', $debt_purchase_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_debt_purchase      = $debt_purchase_debit - $debt_purchase_credit;
      $grandtotal_responbility += $total_debt_purchase;

      $capital            = Coa::where('code', '3.000.00')->first();
      $capital_sub_1      = collect(Coa::select('id')->where('parent_id', $capital->id)->get()->toArray());
      $capital_sub_2      = collect(Coa::select('id')->whereIn('parent_id', $capital_sub_1->flatten())->get()->toArray());
      $capital_sub_3      = collect(Coa::select('id')->whereIn('parent_id', $capital_sub_2->flatten())->get()->toArray());
      $capital_merge      = $capital_sub_1->merge($capital_sub_2->merge($capital_sub_3->merge([$capital->id])));
      $capital_debit      = Journal::whereIn('debit', $capital_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $capital_credit     = Journal::whereIn('credit', $capital_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_capital      = $capital_debit - $capital_credit;
      $grandtotal_equity += $total_capital;

      $opening_balance        = Coa::where('code', '3.100.00')->first();
      $opening_balance_sub_1  = collect(Coa::select('id')->where('parent_id', $opening_balance->id)->get()->toArray());
      $opening_balance_sub_2  = collect(Coa::select('id')->whereIn('parent_id', $opening_balance_sub_1->flatten())->get()->toArray());
      $opening_balance_sub_3  = collect(Coa::select('id')->whereIn('parent_id', $opening_balance_sub_2->flatten())->get()->toArray());
      $opening_balance_merge  = $opening_balance_sub_1->merge($opening_balance_sub_2->merge($opening_balance_sub_3->merge([$opening_balance->id])));
      $opening_balance_debit  = Journal::whereIn('debit', $opening_balance_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $opening_balance_credit = Journal::whereIn('credit', $opening_balance_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_opening_balance  = $opening_balance_debit - $opening_balance_credit;
      $grandtotal_equity     += $total_opening_balance;

      $deviden            = Coa::where('code', '3.200.00')->first();
      $deviden_sub_1      = collect(Coa::select('id')->where('parent_id', $deviden->id)->get()->toArray());
      $deviden_sub_2      = collect(Coa::select('id')->whereIn('parent_id', $deviden_sub_1->flatten())->get()->toArray());
      $deviden_sub_3      = collect(Coa::select('id')->whereIn('parent_id', $deviden_sub_2->flatten())->get()->toArray());
      $deviden_merge      = $deviden_sub_1->merge($deviden_sub_2->merge($deviden_sub_3->merge([$deviden->id])));
      $deviden_debit      = Journal::whereIn('debit', $deviden_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $deviden_credit     = Journal::whereIn('credit', $deviden_merge->flatten())->whereRaw($where_raw)->sum('nominal');
      $total_deviden      = $deviden_debit - $deviden_credit;
      $grandtotal_equity += $total_deviden;

      $retained_earning        = self::profitLossSummary($filter);
      $total_retained_earning  = $retained_earning['grandtotal']['nett']['actual']['current']['nominal'];
      $grandtotal_equity      += $total_retained_earning;

      $result = [
         'assets' => [
            'cash_bank' => [
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
                  'name'    => $dp_sale->name,
                  'balance' => null,
                  'sub'     => $dp_sale_result
               ],
               [
                  'name'    => $debt_business->name,
                  'balance' => null,
                  'sub'     => $debt_business_result
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
                  'name'    => 'Retairned Earning',
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
      return [
         'summary' => self::profitLossSummary($filter)
      ];
   }

   private static function profitLossSummary($filter)
   {
      $month_current     = date('m', strtotime($filter));
      $year_current      = date('Y', strtotime($filter));
      $where_raw_current = "MONTH(created_at) = $month_current AND YEAR(created_at) = $year_current";
      $month_last        = date('m', strtotime('-1 month', strtotime($filter)));
      $year_last         = date('Y', strtotime('-1 month', strtotime($filter)));
      $where_raw_last    = "MONTH(created_at) = $month_last AND YEAR(created_at) = $year_last";

      $income_actual_current   = 0;
      $income_actual_last      = 0;
      $income_budget           = 0;
      $income_variance_current = 0;
      $income_variance_last    = 0;
      $cogs_actual_current     = 0;
      $cogs_actual_last        = 0;
      $cogs_budget             = 0;
      $cogs_variance_current   = 0;
      $cogs_variance_last      = 0;
      $fee_actual_current      = 0;
      $fee_actual_last         = 0;
      $fee_budget              = 0;
      $fee_variance_current    = 0;
      $fee_variance_last       = 0;
      $nett_actual_current     = 0;
      $nett_actual_last        = 0;
      $nett_budget             = 0;

      $sale        = Coa::whereIn('code', ['4.000.01.01', '4.000.01.02'])->get();
      $sale_result = [];
      foreach($sale as $ss) {
         $sale     = Coa::find($ss->id);
         $sale_sub = Coa::where('parent_id', $sale->id)->get();
         foreach($sale_sub as $ss) {
            $sub_1                  = collect(Coa::select('id')->where('parent_id', $ss->id)->get()->toArray());
            $sub_2                  = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
            $sub_merge              = $sub_1->merge(collect([$ss->id])->merge($sub_2));
            $balance_debit_current  = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $balance_credit_current = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $total_balance_current  = abs($balance_debit_current - $balance_credit_current);
            $balance_debit_last     = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $balance_credit_last    = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $total_balance_last     = abs($balance_debit_last - $balance_credit_last);
            $budget                 = Budgeting::where('month', $filter)->where('coa_id', $ss->id)->orderByDesc('id')->limit(1)->get();
            $budget_nominal         = $budget->count() > 0 ? $budget[0]->nominal : 0;
            $variance_current       = $total_balance_current - $budget_nominal;
            $variance_last          = $total_balance_current - $total_balance_last;

            $income_actual_current   += $total_balance_current;
            $income_actual_last      += $total_balance_last;
            $income_budget           += $budget_nominal;
            $income_variance_current += $variance_current;
            $income_variance_last    += $variance_last;

            $sale_result[] = [
               'name'     => $ss->name,
               'actual'   => ['current' => $total_balance_current, 'last' => $total_balance_last],
               'budget'   => $budget_nominal,
               'variance' => [
                  'nominal' => [
                     'current' => $variance_current, 
                     'last'    => $variance_last
                  ],
                  'percent' => [
                     'current' => ($budget_nominal > 0) ? round(($variance_current / $budget_nominal) * 100) : 0,
                     'last'    => ($total_balance_last > 0) ? round(($variance_last / $total_balance_last) * 100) : 0
                  ]
               ]
            ];
         }
      }

      $sale_service        = Coa::whereIn('code', ['4.000.02'])->get();
      $sale_service_result = [];
      foreach($sale_service as $sss) {
         $sale     = Coa::find($sss->id);
         $sale_sub = Coa::where('parent_id', $sale->id)->get();
         foreach($sale_sub as $ss) {
            $sub_1                  = collect(Coa::select('id')->where('parent_id', $ss->id)->get()->toArray());
            $sub_2                  = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
            $sub_merge              = $sub_1->merge(collect([$ss->id])->merge($sub_2));
            $balance_debit_current  = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $balance_credit_current = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $total_balance_current  = abs($balance_debit_current - $balance_credit_current);
            $balance_debit_last     = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $balance_credit_last    = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $total_balance_last     = abs($balance_debit_last - $balance_credit_last);
            $budget                 = Budgeting::where('month', $filter)->where('coa_id', $ss->id)->orderByDesc('id')->limit(1)->get();
            $budget_nominal         = $budget->count() > 0 ? $budget[0]->nominal : 0;
            $variance_current       = $total_balance_current - $budget_nominal;
            $variance_last          = $total_balance_current - $total_balance_last;

            $income_actual_current   += $total_balance_current;
            $income_actual_last      += $total_balance_last;
            $income_budget           += $budget_nominal;
            $income_variance_current += $variance_current;
            $income_variance_last    += $variance_last;

            $sale_service_result[] = [
               'name'     => $ss->name,
               'actual'   => ['current' => $total_balance_current, 'last' => $total_balance_last],
               'budget'   => $budget_nominal,
               'variance' => [
                  'nominal' => [
                     'current' => $variance_current, 
                     'last'    => $variance_last
                  ],
                  'percent' => [
                     'current' => ($budget_nominal > 0) ? round(($variance_current / $budget_nominal) * 100) : 0,
                     'last'    => ($total_balance_last > 0) ? round(($variance_last / $total_balance_last) * 100) : 0
                  ]
               ]
            ];
         }
      }

      $cogs        = Coa::whereIn('code', ['5.000.01', '5.000.02'])->get();
      $cogs_result = [];
      foreach($cogs as $sc) {
         $cogs     = Coa::find($sc->id);
         $cogs_sub = Coa::where('parent_id', $cogs->id)->get();
         foreach($cogs_sub as $cs) {
            $sub_1                  = collect(Coa::select('id')->where('parent_id', $cs->id)->get()->toArray());
            $sub_2                  = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
            $sub_merge              = $sub_1->merge(collect([$cs->id])->merge($sub_2));
            $balance_debit_current  = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $balance_credit_current = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $total_balance_current  = abs($balance_debit_current - $balance_credit_current);
            $balance_debit_last     = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $balance_credit_last    = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $total_balance_last     = abs($balance_debit_last - $balance_credit_last);
            $budget                 = Budgeting::where('month', $filter)->where('coa_id', $cs->id)->orderByDesc('id')->limit(1)->get();
            $budget_nominal         = $budget->count() > 0 ? $budget[0]->nominal : 0;
            $variance_current       = $total_balance_current - $budget_nominal;
            $variance_last          = $total_balance_current - $total_balance_last;

            $cogs_actual_current   += $total_balance_current;
            $cogs_actual_last      += $total_balance_last;
            $cogs_budget           += $budget_nominal;
            $cogs_variance_current += $variance_current;
            $cogs_variance_last    += $variance_last;

            $cogs_result[] = [
               'name'     => $cs->name,
               'actual'   => ['current' => $total_balance_current, 'last' => $total_balance_last],
               'budget'   => $budget_nominal,
               'variance' => [
                  'nominal' => [
                     'current' => $variance_current, 
                     'last'    => $variance_last
                  ],
                  'percent' => [
                     'current' => ($budget_nominal > 0) ? round(($variance_current / $budget_nominal) * 100) : 0,
                     'last'    => ($total_balance_last > 0) ? round(($variance_last / $total_balance_last) * 100) : 0
                  ]
               ]
            ];
         }
      }

      $salary_wages        = Coa::whereIn('code', ['6.200.01.01', '6.200.01.02'])->get();
      $salary_wages_result = [];
      foreach($salary_wages as $ssw) {
         $salary_wages     = Coa::find($ssw->id);
         $salary_wages_sub = Coa::where('parent_id', $salary_wages->id)->get();
         foreach($salary_wages_sub as $sws) {
            $sub_1                  = collect(Coa::select('id')->where('parent_id', $sws->id)->get()->toArray());
            $sub_2                  = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
            $sub_merge              = $sub_1->merge(collect([$sws->id])->merge($sub_2));
            $balance_debit_current  = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $balance_credit_current = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $total_balance_current  = abs($balance_debit_current - $balance_credit_current);
            $balance_debit_last     = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $balance_credit_last    = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $total_balance_last     = abs($balance_debit_last - $balance_credit_last);
            $budget                 = Budgeting::where('month', $filter)->where('coa_id', $sws->id)->orderByDesc('id')->limit(1)->get();
            $budget_nominal         = $budget->count() > 0 ? $budget[0]->nominal : 0;
            $variance_current       = $total_balance_current - $budget_nominal;
            $variance_last          = $total_balance_current - $total_balance_last;

            $fee_actual_current   += $total_balance_current;
            $fee_actual_last      += $total_balance_last;
            $fee_budget           += $budget_nominal;
            $fee_variance_current += $variance_current;
            $fee_variance_last    += $variance_last;

            $actual = [
               'nominal' => [
                  'current' => $total_balance_current, 
                  'last'    => $total_balance_last
               ],
               'percent' => [
                  'current' => ($income_actual_current > 0) ? round(($total_balance_current / $income_actual_current) * 100) : 0,
                  'last'    => ($income_actual_last > 0) ? round(($total_balance_last / $income_actual_last) * 100) : 0
               ]
            ];

            $budgeting = [
               'nominal' => $budget_nominal,
               'percent' => ($income_budget > 0) ? round(($budget_nominal / $income_budget) * 100) : 0
            ];

            $variance = [
               'nominal' => [
                  'current' => $variance_current, 
                  'last'    => $variance_last
               ],
               'percent' => [
                  'current' => ($budget_nominal > 0) ? round(($variance_current / $budget_nominal) * 100) : 0,
                  'last'    => ($total_balance_last > 0) ? round(($variance_last / $total_balance_last) * 100) : 0
               ]
            ];

            $salary_wages_result[] = [
               'name'     => $sws->name,
               'actual'   => $actual,
               'budget'   => $budgeting,
               'variance' => $variance
            ];
         }
      }

      $fee_marketing        = Coa::whereIn('code', ['6.100.01', '6.100.02'])->get();
      $fee_marketing_result = [];
      foreach($fee_marketing as $sfm) {
         $fee_marketing     = Coa::find($sfm->id);
         $fee_marketing_sub = Coa::where('parent_id', $fee_marketing->id)->get();
         foreach($fee_marketing_sub as $fms) {
            $sub_1                  = collect(Coa::select('id')->where('parent_id', $fms->id)->get()->toArray());
            $sub_2                  = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
            $sub_merge              = $sub_1->merge(collect([$fms->id])->merge($sub_2));
            $balance_debit_current  = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $balance_credit_current = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $total_balance_current  = abs($balance_debit_current - $balance_credit_current);
            $balance_debit_last     = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $balance_credit_last    = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $total_balance_last     = abs($balance_debit_last - $balance_credit_last);
            $budget                 = Budgeting::where('month', $filter)->where('coa_id', $fms->id)->orderByDesc('id')->limit(1)->get();
            $budget_nominal         = $budget->count() > 0 ? $budget[0]->nominal : 0;
            $variance_current       = $total_balance_current - $budget_nominal;
            $variance_last          = $total_balance_current - $total_balance_last;

            $fee_actual_current   += $total_balance_current;
            $fee_actual_last      += $total_balance_last;
            $fee_budget           += $budget_nominal;
            $fee_variance_current += $variance_current;
            $fee_variance_last    += $variance_last;

            $actual = [
               'nominal' => [
                  'current' => $total_balance_current, 
                  'last'    => $total_balance_last
               ],
               'percent' => [
                  'current' => ($income_actual_current > 0) ? round(($total_balance_current / $income_actual_current) * 100) : 0,
                  'last'    => ($income_actual_last > 0) ? round(($total_balance_last / $income_actual_last) * 100) : 0
               ]
            ];

            $budgeting = [
               'nominal' => $budget_nominal,
               'percent' => ($income_budget > 0) ? round(($budget_nominal / $income_budget) * 100) : 0
            ];

            $variance = [
               'nominal' => [
                  'current' => $variance_current, 
                  'last'    => $variance_last
               ],
               'percent' => [
                  'current' => ($budget_nominal > 0) ? round(($variance_current / $budget_nominal) * 100) : 0,
                  'last'    => ($total_balance_last > 0) ? round(($variance_last / $total_balance_last) * 100) : 0
               ]
            ];

            $fee_marketing_result[] = [
               'name'     => $fms->name,
               'actual'   => $actual,
               'budget'   => $budgeting,
               'variance' => $variance
            ];
         }
      }

      $fee_other        = Coa::whereIn('code', ['6.2100.01.01', '6.2100.01.02'])->get();
      $fee_other_result = [];
      foreach($fee_other as $sfo) {
         $fee_other     = Coa::find($sfo->id);
         $fee_other_sub = Coa::where('parent_id', $fee_other->id)->get();
         foreach($fee_other_sub as $fos) {
            $sub_1                  = collect(Coa::select('id')->where('parent_id', $fos->id)->get()->toArray());
            $sub_2                  = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
            $sub_merge              = $sub_1->merge(collect([$fos->id])->merge($sub_2));
            $balance_debit_current  = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $balance_credit_current = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $total_balance_current  = abs($balance_debit_current - $balance_credit_current);
            $balance_debit_last     = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $balance_credit_last    = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $total_balance_last     = abs($balance_debit_last - $balance_credit_last);
            $budget                 = Budgeting::where('month', $filter)->where('coa_id', $fos->id)->orderByDesc('id')->limit(1)->get();
            $budget_nominal         = $budget->count() > 0 ? $budget[0]->nominal : 0;
            $variance_current       = $total_balance_current - $budget_nominal;
            $variance_last          = $total_balance_current - $total_balance_last;

            $fee_actual_current   += $total_balance_current;
            $fee_actual_last      += $total_balance_last;
            $fee_budget           += $budget_nominal;
            $fee_variance_current += $variance_current;
            $fee_variance_last    += $variance_last;

            $actual = [
               'nominal' => [
                  'current' => $total_balance_current, 
                  'last'    => $total_balance_last
               ],
               'percent' => [
                  'current' => ($income_actual_current > 0) ? round(($total_balance_current / $income_actual_current) * 100) : 0,
                  'last'    => ($income_actual_last > 0) ? round(($total_balance_last / $income_actual_last) * 100) : 0
               ]
            ];

            $budgeting = [
               'nominal' => $budget_nominal,
               'percent' => ($income_budget > 0) ? round(($budget_nominal / $income_budget) * 100) : 0
            ];

            $variance = [
               'nominal' => [
                  'current' => $variance_current, 
                  'last'    => $variance_last
               ],
               'percent' => [
                  'current' => ($budget_nominal > 0) ? round(($variance_current / $budget_nominal) * 100) : 0,
                  'last'    => ($total_balance_last > 0) ? round(($variance_last / $total_balance_last) * 100) : 0
               ]
            ];

            $fee_other_result[] = [
               'name'     => $fos->name,
               'actual'   => $actual,
               'budget'   => $budgeting,
               'variance' => $variance
            ];
         }
      }

      $fee_maintenance        = Coa::whereIn('code', ['6.2200.01.01', '6.2200.01.02'])->get();
      $fee_maintenance_result = [];
      foreach($fee_maintenance as $sfm) {
         $fee_maintenance     = Coa::find($sfm->id);
         $fee_maintenance_sub = Coa::where('parent_id', $fee_maintenance->id)->get();
         foreach($fee_maintenance_sub as $fms) {
            $sub_1                  = collect(Coa::select('id')->where('parent_id', $fms->id)->get()->toArray());
            $sub_2                  = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
            $sub_merge              = $sub_1->merge(collect([$fms->id])->merge($sub_2));
            $balance_debit_current  = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $balance_credit_current = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $total_balance_current  = abs($balance_debit_current - $balance_credit_current);
            $balance_debit_last     = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $balance_credit_last    = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $total_balance_last     = abs($balance_debit_last - $balance_credit_last);
            $budget                 = Budgeting::where('month', $filter)->where('coa_id', $fms->id)->orderByDesc('id')->limit(1)->get();
            $budget_nominal         = $budget->count() > 0 ? $budget[0]->nominal : 0;
            $variance_current       = $total_balance_current - $budget_nominal;
            $variance_last          = $total_balance_current - $total_balance_last;

            $fee_actual_current   += $total_balance_current;
            $fee_actual_last      += $total_balance_last;
            $fee_budget           += $budget_nominal;
            $fee_variance_current += $variance_current;
            $fee_variance_last    += $variance_last;

            $actual = [
               'nominal' => [
                  'current' => $total_balance_current, 
                  'last'    => $total_balance_last
               ],
               'percent' => [
                  'current' => ($income_actual_current > 0) ? round(($total_balance_current / $income_actual_current) * 100) : 0,
                  'last'    => ($income_actual_last > 0) ? round(($total_balance_last / $income_actual_last) * 100) : 0
               ]
            ];

            $budgeting = [
               'nominal' => $budget_nominal,
               'percent' => ($income_budget > 0) ? round(($budget_nominal / $income_budget) * 100) : 0
            ];

            $variance = [
               'nominal' => [
                  'current' => $variance_current, 
                  'last'    => $variance_last
               ],
               'percent' => [
                  'current' => ($budget_nominal > 0) ? round(($variance_current / $budget_nominal) * 100) : 0,
                  'last'    => ($total_balance_last > 0) ? round(($variance_last / $total_balance_last) * 100) : 0
               ]
            ];

            $fee_maintenance_result[] = [
               'name'     => $fms->name,
               'actual'   => $actual,
               'budget'   => $budgeting,
               'variance' => $variance
            ];
         }
      }

      $fee_shrinkage        = Coa::whereIn('code', ['6.300.00'])->get();
      $fee_shrinkage_result = [];
      foreach($fee_shrinkage as $fs) {
         $fee_shrinkage     = Coa::find($fs->id);
         $fee_shrinkage_sub = Coa::where('parent_id', $fee_shrinkage->id)->get();
         foreach($fee_shrinkage_sub as $fss) {
            $sub_1                  = collect(Coa::select('id')->where('parent_id', $fss->id)->get()->toArray());
            $sub_2                  = collect(Coa::select('id')->whereIn('parent_id', $sub_1->flatten())->get()->toArray());
            $sub_merge              = $sub_1->merge(collect([$fss->id])->merge($sub_2));
            $balance_debit_current  = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $balance_credit_current = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_current)->sum('nominal');
            $total_balance_current  = abs($balance_debit_current - $balance_credit_current);
            $balance_debit_last     = Journal::whereIn('debit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $balance_credit_last    = Journal::whereIn('credit', $sub_merge)->whereRaw($where_raw_last)->sum('nominal');
            $total_balance_last     = abs($balance_debit_last - $balance_credit_last);
            $budget                 = Budgeting::where('month', $filter)->where('coa_id', $fss->id)->orderByDesc('id')->limit(1)->get();
            $budget_nominal         = $budget->count() > 0 ? $budget[0]->nominal : 0;
            $variance_current       = $total_balance_current - $budget_nominal;
            $variance_last          = $total_balance_current - $total_balance_last;

            $nett_actual_current -= $total_balance_current;
            $nett_actual_last    -= $total_balance_last;
            $nett_budget         -= $budget_nominal;

            $actual = [
               'nominal' => [
                  'current' => $total_balance_current, 
                  'last'    => $total_balance_last
               ],
               'percent' => [
                  'current' => ($income_actual_current > 0) ? round(($total_balance_current / $income_actual_current) * 100) : 0,
                  'last'    => ($income_actual_last > 0) ? round(($total_balance_last / $income_actual_last) * 100) : 0
               ]
            ];

            $budgeting = [
               'nominal' => $budget_nominal,
               'percent' => ($income_budget > 0) ? round(($budget_nominal / $income_budget) * 100) : 0
            ];

            $variance = [
               'nominal' => [
                  'current' => $variance_current, 
                  'last'    => $variance_last
               ],
               'percent' => [
                  'current' => ($budget_nominal > 0) ? round(($variance_current / $budget_nominal) * 100) : 0,
                  'last'    => ($total_balance_last > 0) ? round(($variance_last / $total_balance_last) * 100) : 0
               ]
            ];

            $fee_shrinkage_result[] = [
               'name'     => $fss->name,
               'actual'   => $actual,
               'budget'   => $budgeting,
               'variance' => $variance
            ];
         }
      }

      $fee_outside                    = Coa::where('code', '7.200.00')->first();
      $fee_outside_sub_1              = collect(Coa::select('id')->where('parent_id', $fee_outside->id)->get()->toArray());
      $fee_outside_sub_2              = collect(Coa::select('id')->whereIn('parent_id', $fee_outside_sub_1->flatten())->get()->toArray());
      $fee_outside_sub_3              = collect(Coa::select('id')->whereIn('parent_id', $fee_outside_sub_2->flatten())->get()->toArray());
      $fee_outside_merge              = $fee_outside_sub_1->merge($fee_outside_sub_2->merge($fee_outside_sub_3->merge([$fee_outside->id])));
      $fee_outside_debit_current      = Journal::whereIn('debit', $fee_outside_merge->flatten())->whereRaw($where_raw_current)->sum('nominal');
      $fee_outside_credit_current     = Journal::whereIn('credit', $fee_outside_merge->flatten())->whereRaw($where_raw_current)->sum('nominal');
      $total_fee_outside_current      = abs($fee_outside_debit_current - $fee_outside_credit_current);
      $fee_outside_debit_last         = Journal::whereIn('debit', $fee_outside_merge->flatten())->whereRaw($where_raw_last)->sum('nominal');
      $fee_outside_credit_last        = Journal::whereIn('credit', $fee_outside_merge->flatten())->whereRaw($where_raw_last)->sum('nominal');
      $total_fee_outside_last         = abs($fee_outside_debit_last - $fee_outside_credit_last);
      $fee_outside_budget             = Budgeting::where('month', $filter)->whereIn('coa_id', $fee_outside_merge)->orderByDesc('id')->limit(1)->get();
      $fee_outside_budget_nominal     = $fee_outside_budget->count() > 0 ? $fee_outside_budget[0]->nominal : 0;
      $fee_outside_variance_current   = $total_fee_outside_current - $fee_outside_budget_nominal;
      $fee_outside_variance_last      = $total_fee_outside_current - $total_fee_outside_last;

      $nett_actual_current += $total_fee_outside_current;
      $nett_actual_last    += $total_fee_outside_last;
      $nett_budget         += $fee_outside_budget_nominal;

      $income_outside                   = Coa::where('code', '7.100.00')->first();
      $income_outside_sub_1             = collect(Coa::select('id')->where('parent_id', $income_outside->id)->get()->toArray());
      $income_outside_sub_2             = collect(Coa::select('id')->whereIn('parent_id', $income_outside_sub_1->flatten())->get()->toArray());
      $income_outside_sub_3             = collect(Coa::select('id')->whereIn('parent_id', $income_outside_sub_2->flatten())->get()->toArray());
      $income_outside_merge             = $income_outside_sub_1->merge($income_outside_sub_2->merge($income_outside_sub_3->merge([$income_outside->id])));
      $income_outside_debit_current     = Journal::whereIn('debit', $income_outside_merge->flatten())->whereRaw($where_raw_current)->sum('nominal');
      $income_outside_credit_current    = Journal::whereIn('credit', $income_outside_merge->flatten())->whereRaw($where_raw_current)->sum('nominal');
      $total_income_outside_current     = abs($income_outside_debit_current - $income_outside_credit_current);
      $income_outside_debit_last        = Journal::whereIn('debit', $income_outside_merge->flatten())->whereRaw($where_raw_last)->sum('nominal');
      $income_outside_credit_last       = Journal::whereIn('credit', $income_outside_merge->flatten())->whereRaw($where_raw_last)->sum('nominal');
      $total_income_outside_last        = abs($income_outside_debit_last - $income_outside_credit_last);
      $income_outside_budget            = Budgeting::where('month', $filter)->whereIn('coa_id', $income_outside_merge)->orderByDesc('id')->limit(1)->get();
      $income_outside_budget_nominal    = $income_outside_budget->count() > 0 ? $income_outside_budget[0]->nominal : 0;
      $income_outside_variance_current  = $total_income_outside_current - $income_outside_budget_nominal;
      $income_outside_variance_last     = $total_income_outside_current - $total_income_outside_last;

      $nett_actual_current += $total_income_outside_current;
      $nett_actual_last    += $total_income_outside_last;
      $nett_budget         += $income_outside_budget_nominal;

      $fee_income_outside_result = [
         [
            'name' => $fee_outside->name,
            'actual' => [
               'nominal' => [
                  'current' => $total_fee_outside_current, 
                  'last'    => $total_fee_outside_last
               ],
               'percent' => [
                  'current' => ($income_actual_current > 0) ? round(($total_fee_outside_current / $income_actual_current) * 100) : 0,
                  'last'    => ($income_actual_last > 0) ? round(($total_fee_outside_last / $income_actual_last) * 100) : 0
               ]
            ],
            'budget' => [
               'nominal' => $fee_outside_budget_nominal,
               'percent' => ($income_budget > 0) ? round(($fee_outside_budget_nominal / $income_budget) * 100) : 0
            ],
            'variance' => [
               'nominal' => [
                  'current' => $fee_outside_variance_current, 
                  'last'    => $fee_outside_variance_last
               ],
               'percent' => [
                  'current' => ($fee_outside_budget_nominal > 0) ? round(($fee_outside_variance_current / $fee_outside_budget_nominal) * 100) : 0,
                  'last'    => ($total_fee_outside_last > 0) ? round(($fee_outside_variance_last / $total_fee_outside_last) * 100) : 0
               ]
            ]
         ],
         [
            'name' => $income_outside->name,
            'actual' => [
               'nominal' => [
                  'current' => $total_income_outside_current, 
                  'last'    => $total_income_outside_last
               ],
               'percent' => [
                  'current' => ($income_actual_current > 0) ? round(($total_income_outside_current / $income_actual_current) * 100) : 0,
                  'last'    => ($income_actual_last > 0) ? round(($total_income_outside_last / $income_actual_last) * 100) : 0
               ]
            ],
            'budget' => [
               'nominal' => $income_outside_budget_nominal,
               'percent' => ($income_budget > 0) ? round(($income_outside_budget_nominal / $income_budget) * 100) : 0
            ],
            'variance' => [
               'nominal' => [
                  'current' => $income_outside_variance_current, 
                  'last'    => $income_outside_variance_last
               ],
               'percent' => [
                  'current' => ($income_outside_budget_nominal > 0) ? round(($income_outside_variance_current / $income_outside_budget_nominal) * 100) : 0,
                  'last'    => ($total_income_outside_last > 0) ? round(($income_outside_variance_last / $total_income_outside_last) * 100) : 0
               ]
            ]
         ]
      ];

      $total = [
         'income' => [
            'budget'   => $income_budget,
            'actual'   => ['current' => $income_actual_current, 'last' => $income_actual_last],
            'variance' => ['current' => $income_variance_current, 'last' => $income_variance_last]
         ],
         'cogs' => [
            'budget'   => $cogs_budget,
            'actual'   => ['current' => $cogs_actual_current, 'last' => $cogs_actual_last],
            'variance' => ['current' => $cogs_variance_current, 'last' => $cogs_variance_last]
         ],
         'fee' => [
            'budget'   => $fee_budget,
            'actual'   => ['current' => $fee_actual_current, 'last' => $fee_actual_last],
            'variance' => ['current' => $fee_variance_current, 'last' => $fee_variance_last]
         ],
      ];

      $gross_actual_nominal_current   = $income_actual_current - $cogs_actual_current - $fee_actual_current;
      $gross_actual_nominal_last      = $income_actual_last - $cogs_actual_last - $fee_actual_last;
      $gross_actual_percent_current   = 0;
      $gross_actual_percent_last      = 0;
      $gross_budget_nominal           = $income_budget - $cogs_budget - $fee_budget;
      $gross_budget_percent           = 0;
      $gross_variance_nominal_current = $gross_actual_nominal_current - $gross_budget_nominal;
      $gross_variance_nominal_last    = $gross_actual_nominal_current - $gross_actual_nominal_last;
      $gross_variance_percent_current = 0;
      $gross_variance_percent_last    = 0;
      
      if($income_actual_current > 0) {
         $gross_actual_percent_current = round(($gross_actual_nominal_current / $income_actual_current) * 100);
      }

      if($income_budget > 0) {
         $gross_budget_percent = round(($gross_budget_nominal / $income_budget) * 100);
      }

      if($gross_budget_nominal > 0) {
         $gross_variance_percent_current = round(($gross_variance_nominal_current / $gross_budget_nominal) * 100);
      }

      if($income_actual_last > 0) {
         $gross_actual_percent_last = round(($gross_actual_nominal_current / $income_actual_last) * 100);
      }

      if($gross_actual_nominal_last > 0) {
         $gross_variance_percent_last = round(($gross_variance_nominal_last / $gross_actual_nominal_last) * 100);
      }

      $nett_actual_nominal_current   = $nett_actual_current;
      $nett_actual_nominal_last      = $gross_actual_nominal_current - $nett_actual_last;
      $nett_actual_percent_current   = 0;
      $nett_actual_percent_last      = 0;
      $nett_budget_nominal           = $nett_budget;
      $nett_budget_percent           = 0;
      $nett_variance_nominal_current = $nett_actual_nominal_current - $nett_budget_nominal;
      $nett_variance_nominal_last    = $nett_actual_nominal_current - $nett_actual_nominal_last;
      $nett_variance_percent_current = 0;
      $nett_variance_percent_last    = 0;

      if($income_actual_current > 0) {
         $nett_actual_percent_current = round(($nett_actual_nominal_current / $income_actual_current) * 100);
      }

      if($income_budget > 0) {
         $nett_budget_percent = round(($nett_budget_nominal / $income_budget) * 100);
      }

      if($nett_budget_nominal > 0) {
         $nett_variance_percent_current = round(($nett_variance_nominal_current / $nett_budget_nominal) * 100);
      }

      if($income_actual_last > 0) {
         $nett_actual_percent_last = round(($nett_actual_nominal_last / $income_actual_last) * 100);
      }

      if($nett_actual_nominal_last > 0) {
         $nett_variance_percent_last = round(($nett_variance_nominal_last / $nett_actual_nominal_last) * 100);
      }

      $grandtotal = [
         'gross' => [
            'actual' => [
               'current' => [
                  'nominal' => $gross_actual_nominal_current,
                  'percent' => $gross_actual_percent_current
               ],
               'last' => [
                  'nominal' => $gross_actual_nominal_last,
                  'percent' => $gross_actual_percent_last
               ]
            ],
            'budget' => [
               'nominal' => $gross_budget_nominal,
               'percent' => $gross_budget_percent
            ],
            'variance' => [
               'current' => [
                  'nominal' => $gross_variance_nominal_current,
                  'percent' => $gross_variance_percent_current
               ],
               'last' => [
                  'nominal' => $gross_variance_nominal_last,
                  'percent' => $gross_variance_percent_last
               ]
            ],
         ],
         'nett' => [
            'actual' => [
               'current' => [
                  'nominal' => $nett_actual_nominal_current,
                  'percent' => $nett_actual_percent_current
               ],
               'last' => [
                  'nominal' => $nett_actual_nominal_last,
                  'percent' => $nett_actual_percent_last
               ]
            ],
            'budget' => [
               'nominal' => $nett_budget_nominal,
               'percent' => $nett_budget_percent
            ],
            'variance' => [
               'current' => [
                  'nominal' => $nett_variance_nominal_current,
                  'percent' => $nett_variance_percent_current
               ],
               'last' => [
                  'nominal' => $nett_variance_nominal_last,
                  'percent' => $nett_variance_percent_last
               ]
            ],
         ] 
      ];

      return [
         'sale'               => $sale_result,
         'sale_service'       => $sale_service_result,
         'cogs'               => $cogs_result,
         'salary_wages'       => $salary_wages_result,
         'fee_marketing'      => $fee_marketing_result,
         'fee_other'          => $fee_other_result,
         'fee_maintenance'    => $fee_maintenance_result,
         'fee_shrinkage'      => $fee_shrinkage_result,
         'fee_income_outside' => $fee_income_outside_result,
         'total'              => $total,
         'grandtotal'         => $grandtotal
      ];
   }

}