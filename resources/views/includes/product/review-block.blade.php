<div class="ps-block--review {{ !$loop->first ? 'mt-5' : '' }}">
  <div class="ps-block__content pl-0">
    <figure>
      <figcaption>
        By <strong>{{ $review['customer_name'] }}</strong>
        <span>{{ $review['created_at'] }}</span>
      </figcaption>
      <select class="ps-rating" data-read-only="true">
        @for ($i = 0; $i <= 5; $i++)
          <option value="{{ $i }}" {{ $i <= $review['rating'] ? 'selected' : '' }}>{{ $i }}</option>
        @endfor
      </select>
    </figure>
    <p>{!! $review['body'] !!}</p>
  </div>
</div>