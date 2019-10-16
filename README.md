**The test shows that**

1.Build the local PHP environment.

2.Go to localhost/index.php
    
    e.g localhost/index.php
    e.g localhost/index.php?test=test_one
3.Directory description

    --config   
        --goodsPriceArray   Commodity price allocation
        --goodsRules        Commodity regulation control
    --model
        ...
    --test
        --test_one          The test data(This data is used by default)
        ...
        
 _**notice**_: If you want to run a PHP file with the cli, you first bind the cli PHP action and then use php-f, but only for the default parameters.