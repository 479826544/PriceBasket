**测试说明**

1.构建本地PHP环境。

2.访问localhost / index . php   
        
    e.g localhost/index.php
    e.g localhost/index.php?test=test_one

3.目录描述
    
    --config   
            --goodsPriceArray   Commodity price allocation
            --goodsRules        Commodity regulation control
        --model
            ...
        --test
            --test_one          The test data(This data is used by default)
            ...
        
_注意_:如果希望使用cli运行PHP文件，首先绑定cli PHP操作，然后使用PHP -f，但只针对默认参数。




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