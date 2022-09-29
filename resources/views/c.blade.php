<x-guest-layout>
    <div class="carrousel_3d_container" id="carrousel_3d-slider" x-data="{
        item: $el.querySelectorAll('.carrousel_3d_item'),
        arrow: $el.querySelectorAll('.carrousel_3d_arrow'),
        defaultIndex: 0,
        nowIndex: 0,
        itemCount: 0,
        prev() {
            if (this.nowIndex == this.itemCount - 1) {
                this.changeIndex(0);
            } else {
                this.changeIndex(this.nowIndex++);
            }
        },
        next() {
            if (this.nowIndex == 0) {
                this.changeIndex(this.itemCount - 1);
            } else {
                this.changeIndex(this.nowIndex--);
            }
        },
        slider() {
            this.itemCount = this.item.length;
            this.changeIndex(this.defaultIndex);
            for (var i = 0; i < this.item; i++) {
                document.querySelector('.carrousel_3d_item').each(function(i) {
                    document.querySelector(this).attr('data-slide-number', [i]);
                });
            }
        },
        changeIndex(nowIndex) {
            Object.values(this.item).map(function(i) {
                i.classList.remove('now');
                i.classList.remove('next');
                i.classList.remove('prev');
            })
    
            if (nowIndex == this.itemCount - 1) {
                this.item[0].classList.add('next');
            }
            if (nowIndex == 0) {
                this.item[this.itemCount - 1].classList.add('prev');
            }
            Object.keys(this.item).map(function(index) {
                console.log(index)
                if (index == nowIndex) {
                    this.item[index].classList.add('now');
                }
                if (index == nowIndex + 1) {
                    this.item[index].classList.add('next');
                }
                if (index == nowIndex - 1) {
                    this.item[index].classList.add('prev');
                }
            })
    
        }
    }">
        <div class="carrousel_3d_slides" x-init="slider">
            <div class="carrousel_3d_item">
                <div class="maintexto">
                    <div class="boxtexto">
                        <div class="bottom"></div>
                        <div class="bottomleft"></div>
                        <p>
                            "My God! It's Watson," said he. He was in a pitiable state of reaction, with every nerve in
                            a
                            twitter. "I Watson
                        </p>
                    </div>
                </div>
                <img src="{{ asset('img/carrouseralfa/01.fw.png') }}" alt="">
            </div>
            <div class="carrousel_3d_item">
                <div class="maintexto">
                    <div class="boxtexto">
                        <div class="bottom"></div>
                        <div class="bottomleft"></div>
                        <p>
                            "My God! It's Watson," said he. He was in a pitiable state of reaction, with every nerve in
                            a
                            twitter. "I Watson
                        </p>
                    </div>
                </div>
                <img src="{{ asset('img/carrouseralfa/02.fw.png') }}" alt="">
            </div>

            <div class="carrousel_3d_item">
                <div class="maintexto">
                    <div class="boxtexto">
                        <div class="bottom"></div>
                        <div class="bottomleft"></div>
                        <p>
                            "My God! It's Watson," said he. He was in a pitiable state of reaction, with every nerve in
                            a
                            twitter. "I Watson
                        </p>
                    </div>
                </div>
                <img src="{{ asset('img/carrouseralfa/03.fw.png') }}" alt="">
            </div>
        </div>
        <span class="carrousel_3d_arrow carrousel_3d_arrow-left" x-on:click="prev()">
            <img width="25px" src="{{ asset('img/carrouseralfa/prev.fw.png') }}"></span>
        <span class="carrousel_3d_arrow carrousel_3d_arrow-right" x-on:click="next()">
            <img width="25px" src="{{ asset('img/carrouseralfa/next.fw.png') }}"></span>
    </div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        (function($) {

            $.fn.slider = function(opt) {
                var $this = this,
                    itemClass = 'carrousel_3d_item',
                    arrowClass = 'carrousel_3d_arrow',
                    $item = $this.find('.' + itemClass),
                    $arrow = $this.find('.' + arrowClass),
                    itemCount = $item.length;

                var defaultIndex = 0;

                changeIndex(defaultIndex);

                // $arrow.on('click', function() {
                //     var action = $(this).data('action'),
                //         nowIndex = $item.index($this.find('.now'));

                //     if (action == 'next') {
                //         if (nowIndex == itemCount - 1) {
                //             changeIndex(0);
                //         } else {
                //             changeIndex(nowIndex + 1);
                //         }
                //     } else if (action == 'prev') {
                //         if (nowIndex == 0) {
                //             changeIndex(itemCount - 1);
                //         } else {
                //             changeIndex(nowIndex - 1);
                //         }
                //     }

                // });


                for (var i = 0; i < itemCount; i++) {
                    document.querySelector('.carrousel_3d_item').each(function(i) {
                        document.querySelector(this).attr('data-slide-number', [i]);
                    });
                }



                function changeIndex(nowIndex) {
                    // clern all class
                    $this.find('.now').removeClass('now');
                    $this.find('.next').removeClass('next');
                    $this.find('.prev').removeClass('prev');


                    if (nowIndex == itemCount - 1) {
                        $item.eq(0).addClass('next');
                    }
                    if (nowIndex == 0) {
                        $item.eq(itemCount - 1).addClass('prev');
                    }

                    $item.each(function(index) {
                        if (index == nowIndex) {
                            $item.eq(index).addClass('now');
                        }
                        if (index == nowIndex + 1) {
                            $item.eq(index).addClass('next');
                        }
                        if (index == nowIndex - 1) {
                            $item.eq(index).addClass('prev');
                        }
                    });
                }
            };
        })(jQuery);

        // $('#carrousel_3d-slider').slider({
        //     //   itemClass: 'carrousel_3d_item',
        //     //   arrowClass: 'carrousel_3d_arrow'
        // });
    </script>
    @push('styles')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;800&display=swap');

            body {
                font-family: 'Open Sans', sans-serif;
            }


            .carrousel_3d_container {
                width: 1200px;
                height: 630px;
                margin: 0px auto;
                position: relative;
            }

            .carrousel_3d_item {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translateY(-50%) translateX(-50%) scale(0.3);
                transition: all 0.5s ease;
                opacity: 0;
                z-index: -1;
                text-align: center;
                width: 686px;
                height: 686px;
            }

            .carrousel_3d_item img {
                width: 686px;
                height: auto;
            }

            .carrousel_3d_item.next {
                left: 70%;
                transform: translateY(-50%) translateX(-150%) scale(0.5);
                opacity: 1;
                z-index: 1;
            }

            .carrousel_3d_item.prev {
                left: 30%;
                transform: translateY(-50%) translateX(50%) scale(0.5);
                opacity: 1;
                z-index: 1;
            }

            .carrousel_3d_item.prev .maintexto {
                display: none;
            }

            .carrousel_3d_item.next .maintexto {
                display: none;
            }

            .carrousel_3d_item.now {
                top: 50%;
                left: 50%;
                transform: translateY(-50%) translateX(-50%) scale(0.9);
                opacity: 1;
                z-index: 5;
                background: none;
                animation: fadeBackground 0.5s;
                animation-fill-mode: forwards;
            }

            @keyframes fadeBackground {
                from {
                    background: none;
                }

                to {
                    background-image: url('bg-alider-redondo.fw.png');
                    background-position: bottom center;
                    background-repeat: no-repeat;
                }
            }

            .carrousel_3d_arrow {
                display: inline-block;
                position: absolute;
                top: 45%;
                cursor: pointer;
                z-index: 5;
            }

            .carrousel_3d_arrow-left {
                left: 25%;
            }

            .carrousel_3d_arrow-right {
                right: 25%;
            }

            .maintexto {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .boxtexto {
                width: 660px;
                height: 30ex;
                position: absolute;
                overflow: hidden;
                margin-top: 850px;
                z-index: 6;
            }

            .boxtexto::after {
                content: '';
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                box-sizing: border-box;
            }

            .boxtexto p {
                font-size: 40px;
                line-height: 0.9;
                color: #fff;
            }

            .bottomleft,
            .bottom {
                width: 50%;
                height: 100%;
            }

            .bottom {
                float: right;
                bottom: 0;
                clip-path: polygon(0% 100%, 100% 100%, 100% 0%);
                shape-outside: polygon(0% 100%, 100% 100%, 100% 0%);
            }

            .bottomleft {
                float: left;
                bottom: 0;
                clip-path: polygon(100% 100%, 0% 100%, 0% 0%);
                shape-outside: polygon(100% 100%, 0% 100%, 0% 0%);
            }



            @media (max-width: 600px) {
                .carrousel_3d_container {
                    position: relative;
                    width: 600px;
                    height: 630px;
                    margin: 0px auto;
                }

                .carrousel_3d_item {
                    display: none;
                }

                .carrousel_3d_item.now {
                    top: 50%;
                    left: 50%;
                    transform: translateY(-50%) translateX(-50%) scale(0.9);
                    opacity: 1;
                    z-index: 5;
                    background: none;
                    animation: fadeBackground 0.5s;
                    animation-fill-mode: forwards;
                    display: block;
                }

                .carrousel_3d_arrow {
                    display: inline-block;
                    position: absolute;
                    top: 45%;
                    cursor: pointer;
                    z-index: 5;
                }

                .carrousel_3d_arrow-left {
                    left: 5%;
                }

                .carrousel_3d_arrow-right {
                    right: 5%;
                }
            }

            /*
                                @media (max-width: 1000px)
                                 {
                                    .carrousel_3d_container {
                                    position: relative;
                                    width: 1000px;
                                    height: 630px;
                                    margin: 0px auto;
                                 } */


            /*
                                } */
        </style>
    @endpush
</x-guest-layout>
