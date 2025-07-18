{!! '<' . '?xml version="1.0" encoding="utf-8" ?' . '>' !!}
<RetailInvoiceBulk xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="schema.xsd">
    <TIN>5108060103710001</TIN>
    <TaxPeriodMonth>{{ $month }}</TaxPeriodMonth>
    <TaxPeriodYear>{{ $year }}</TaxPeriodYear>
    <ListOfRetailInvoice>
@foreach($sales as $sale)
        <RetailInvoice>
            <TrxCode>Normal</TrxCode>
            <BuyerName>{{ $sale['buyer_name'] }}</BuyerName>
            <BuyerIdOpt>NIK</BuyerIdOpt>
            <BuyerIdNumber>0000000000000000</BuyerIdNumber>
            <GoodServiceOpt>A</GoodServiceOpt>
            <SerialNo>{{ $sale['serial_no'] }}</SerialNo>
            <TransactionDate>{{ $sale['transaction_date'] }}</TransactionDate>
            <TaxBaseSellingPrice>{{ intval($sale['tax_base_selling_price']) }}</TaxBaseSellingPrice>
            <OtherTaxBaseSellingPrice>{{ intval($sale['other_tax_base_selling_price']) }}</OtherTaxBaseSellingPrice>
            <VAT>{{ intval($sale['vat']) }}</VAT>
            <STLG>0</STLG>
            <Info/>
        </RetailInvoice>
@endforeach
    </ListOfRetailInvoice>
</RetailInvoiceBulk>
