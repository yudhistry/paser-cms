<div class="slider-container rev_slider_wrapper" style="height: 300px;">
  <div id="revolutionSlider" class="slider rev_slider" data-version="5.4.8" data-plugin-revolution-slider data-plugin-options="{'delay': 9000, 'gridwidth': 1170, 'gridheight': 300, 'disableProgressBar': 'on', 'responsiveLevels': [4096,1200,992,500], 'parallax': { 'type': 'scroll', 'origo': 'enterpoint', 'speed': 1000, 'levels': [2,3,4,5,6,7,8,9,12,50], 'disable_onmobile': 'on' }, 'navigation' : {'arrows': { 'enable': true }, 'bullets': {'enable': true, 'style': 'bullets-style-1', 'h_align': 'center', 'v_align': 'bottom', 'space': 7, 'v_offset': 70, 'h_offset': 0}}}">
    <ul>
      <?php foreach($slide as $row){ ?>
      <li data-transition="fade" style="text-shadow: 2px 2px 2px #000000">
        <img src="<?php echo $row->slide_url;?>"
          alt=""
          data-bgposition="center center"
          data-bgfit="cover"
          data-bgrepeat="no-repeat"
          class="rev-slidebg">
        <div class="tp-caption text-color-light font-weight-normal"
          data-x="center"
          data-y="center" data-voffset="['-50','-50','-50','-75']"
          data-start="700"
          data-fontsize="['22','22','22','40']"
          data-lineheight="['25','25','25','45']"
          data-transform_in="y:[-50%];opacity:0;s:500;">SELAMAT DATANG DI WEBSITE RESMI</div>

        <div class="tp-caption font-weight-extra-bold text-color-light negative-ls-2"
          data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:1.5;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
          data-x="center"
          data-y="center"
          data-fontsize="['30','30','30','50']"
          data-lineheight="['55','55','55','95']">DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</div>

        <div class="tp-caption font-weight-semibold"
          data-frames='[{"from":"opacity:0;","speed":300,"to":"o:1;","delay":2000,"split":"chars","splitdelay":0.05,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
          data-x="center"
          data-y="center" data-voffset="['40','40','40','80']"
          data-fontsize="['25','25','25','50']"
          data-lineheight="['20','20','20','95']"
          style="color: #FFFFFF">PEMERINTAH KABUPATEN PASER</div>
      </li>
    <?php } ?>
    </ul>
  </div>
</div>
